<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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
        $token = (string) config('deploy.token', '');
        if ($token === '') {
            return response()->json([
                'status' => 'error',
                'message' => 'DEPLOY_TOKEN is not set in .env on the server.',
            ], Response::HTTP_FORBIDDEN);
        }

        $provided = (string) ($request->query('token') ?? $request->header('X-Deploy-Token', ''));
        if (! hash_equals($token, $provided)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid deploy token.',
            ], Response::HTTP_FORBIDDEN);
        }

        $steps = [];

        $steps['removed_stale_bootstrap_cache'] = $this->removeStaleBootstrapCache();

        foreach ([
            'migrate' => ['migrate', ['--force' => true]],
            'storage_link' => ['storage:link', []],
            'optimize' => ['optimize', []],
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
}
