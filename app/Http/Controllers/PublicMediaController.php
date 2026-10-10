<?php

namespace App\Http\Controllers;

use App\Support\LegacyPublicPath;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Serves upload paths that exist only under public_html when the app web root is public/.
 */
class PublicMediaController extends Controller
{
    private const ALLOWED_PREFIXES = [
        'doctor-profiles/',
        'doctor_profiles/',
        'doctor/',
        'doctor-documents/',
        'blog/',
        'blog_images/',
        'services/',
        'service_images/',
    ];

    public function show(string $path): BinaryFileResponse
    {
        $path = str_replace(['..', '\\'], '', $path);
        $path = ltrim(str_replace('\\', '/', $path), '/');

        $ok = false;
        foreach (self::ALLOWED_PREFIXES as $prefix) {
            if (Str::startsWith($path, $prefix)) {
                $ok = true;
                break;
            }
        }
        if (! $ok) {
            abort(404);
        }

        // Define lookups (Primary and Alternatives for renamed folders)
        $pathsToTry = [$path];
        if (Str::startsWith($path, 'blog/')) {
            $pathsToTry[] = str_replace('blog/', 'blog_images/', $path);
        } elseif (Str::startsWith($path, 'services/')) {
            $pathsToTry[] = str_replace('services/', 'service_images/', $path);
        }

        foreach ($pathsToTry as $p) {
            // Check public/
            $fullPublic = public_path($p);
            if (is_file($fullPublic)) {
                return response()->file($fullPublic);
            }

            // Check storage/app/public/
            $storagePublic = storage_path('app/public/'.$p);
            if (is_file($storagePublic)) {
                return response()->file($storagePublic);
            }

            $legacy = LegacyPublicPath::filePath($p);
            if ($legacy !== null) {
                return response()->file($legacy);
            }
        }

        abort(404, 'File not found: ' . $path);
    }
}
