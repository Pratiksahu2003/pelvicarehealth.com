<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

/**
 * One-click production setup when Hostinger hPanel has no SSH terminal.
 * Set DEPLOY_TOKEN in .env, visit /deploy/run?token=YOUR_TOKEN once after upload.
 */
class DeployController extends Controller
{
    public function run(Request $request): JsonResponse
    {
        if ((string) config('deploy.token', '') === '') {
            return response()->json([
                'status' => 'error',
                'message' => 'DEPLOY_TOKEN is not set in .env on the server.',
            ], Response::HTTP_FORBIDDEN);
        }

        if (! $this->tokenMatches($request)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid deploy token.',
            ], Response::HTTP_FORBIDDEN);
        }

        $steps = [];

        $steps['removed_stale_bootstrap_cache'] = $this->removeStaleBootstrapCache();

        foreach ([
            'config_clear' => ['config:clear', []],
            'migrate' => ['migrate', ['--force' => true]],
            'storage_link' => ['storage:link', []],
            // Do not run config:cache / optimize — it freezes old DB_* values in bootstrap/cache/config.php
            'route_cache' => ['route:cache', []],
            'view_cache' => ['view:cache', []],
            'event_cache' => ['event:cache', []],
        ] as $label => [$command, $arguments]) {
            try {
                Artisan::call($command, $arguments);
                $steps[$label] = [
                    'ok' => true,
                    'output' => trim(Artisan::output()),
                ];
            } catch (\Throwable $e) {
                $steps[$label] = [
                    'ok' => false,
                    'output' => trim(Artisan::output()),
                    'error' => $e->getMessage(),
                ];
            }
        }

        $allOk = collect($steps)
            ->except('removed_stale_bootstrap_cache')
            ->every(fn (array $step): bool => ($step['ok'] ?? false) === true);

        return response()->json([
            'status' => $allOk ? 'success' : 'partial',
            'message' => $allOk
                ? 'Production caches built on this server. Remove or rotate DEPLOY_TOKEN when done.'
                : 'Some steps failed (see steps). Fix .env / permissions and run again.',
            'steps' => $steps,
        ], $allOk ? Response::HTTP_OK : Response::HTTP_MULTI_STATUS);
    }

    /**
     * Windows/macOS bootstrap/cache must never be uploaded to Linux hosting.
     *
     * @return array{removed: list<string>}
     */
    private function removeStaleBootstrapCache(): array
    {
        $removed = [];
        $cacheDir = base_path('bootstrap/cache');

        foreach (File::glob($cacheDir.'/*.php') ?: [] as $file) {
            File::delete($file);
            $removed[] = basename($file);
        }

        return ['removed' => $removed];
    }

    public function dbCheck(Request $request): JsonResponse
    {
        if (! $this->tokenMatches($request)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or missing deploy token.',
            ], Response::HTTP_FORBIDDEN);
        }

        $this->removeStaleBootstrapCache();
        Artisan::call('config:clear');

        $connection = (string) config('database.default');
        $mysql = config('database.connections.mysql');

        $summary = [
            'connection' => $connection,
            'host' => $mysql['host'] ?? null,
            'port' => $mysql['port'] ?? null,
            'database' => $mysql['database'] ?? null,
            'username' => $mysql['username'] ?? null,
            'password_set' => ($mysql['password'] ?? '') !== '',
        ];

        try {
            DB::connection()->getPdo();
            DB::select('select 1 as ok');

            return response()->json([
                'status' => 'success',
                'message' => 'Database connection OK.',
                'config' => $summary,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database connection failed.',
                'config' => $summary,
                'error' => $e->getMessage(),
                'hostinger_checklist' => [
                    'In hPanel → Databases, copy MySQL Database, User, and Password for THIS hosting account (username prefix must match, e.g. u225235608_...).',
                    'Assign the user to the database with All Privileges.',
                    'Use DB_HOST=127.0.0.1 or localhost and DB_PORT=3306.',
                    'If the password contains # or $, wrap DB_PASSWORD in double quotes in .env.',
                    'After editing .env, delete bootstrap/cache/config.php or open /deploy/run?token=... again.',
                ],
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }

    private function tokenMatches(Request $request): bool
    {
        $token = (string) config('deploy.token', '');
        if ($token === '') {
            return false;
        }

        $provided = (string) ($request->query('token') ?? $request->header('X-Deploy-Token', ''));

        return hash_equals($token, $provided);
    }
}
