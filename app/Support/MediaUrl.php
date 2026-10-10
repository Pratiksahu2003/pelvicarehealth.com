<?php

namespace App\Support;

use Illuminate\Support\Str;

/**
 * Resolves URLs for files on the public disk, direct public/ assets, or absolute URLs.
 * DB paths from uploads are usually relative to storage/app/public (URLs like /storage/...).
 *
 * On shared hosting you do not need `storage:link`: enable `serve` => true on the `public`
 * disk in config/filesystems.php so Laravel serves those files (see FilesystemServiceProvider).
 */
class MediaUrl
{
    public static function url(?string $path): ?string
    {
        if ($path === null) {
            return null;
        }

        $path = trim($path);
        if ($path === '') {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://', '//'])) {
            return $path;
        }

        $path = ltrim(str_replace('\\', '/', $path), '/');

        if (Str::startsWith($path, 'storage/')) {
            return asset($path);
        }

        // Files placed directly under public/ (e.g. images/foo.png, doctor-profiles/x.jpg)
        if (is_file(public_path($path))) {
            return asset($path);
        }

        // Laravel public disk: storage/app/public → /storage/{path}
        if (is_file(storage_path('app/public/'.$path))) {
            return asset('storage/'.$path);
        }

        // Check primary and alternate fallback paths (legacy sibling public_html/ on local dev)
        $pathsToTry = [$path];
        if (Str::startsWith($path, 'blog/')) {
            $pathsToTry[] = str_replace('blog/', 'blog_images/', $path);
        } elseif (Str::startsWith($path, 'services/')) {
            $pathsToTry[] = str_replace('services/', 'service_images/', $path);
        }

        foreach ($pathsToTry as $p) {
            $publicHtmlFile = LegacyPublicPath::filePath($p);
            if ($publicHtmlFile !== null && self::isMediaFallbackPath($p)) {
                return route('media.public', ['path' => $p], false);
            }
        }

        // Laravel public disk: best-effort URL for legacy rows
        return asset('storage/'.$path);
    }

    /**
     * Paths allowed to be served via /media/{path} fallback.
     */
    private static function isMediaFallbackPath(string $path): bool
    {
        return Str::startsWith($path, ['doctor-profiles/', 'doctor_profiles/', 'doctor/', 'doctor-documents/', 'blog/', 'blog_images/', 'services/', 'service_images/']);
    }
}
