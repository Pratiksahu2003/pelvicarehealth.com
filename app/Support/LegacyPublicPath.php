<?php

namespace App\Support;

/**
 * Optional sibling directory (e.g. public_html/) used for legacy uploads when the
 * web root is public/. Not used on standard Hostinger deploys where uploads live under public/.
 */
final class LegacyPublicPath
{
    public static function root(): string
    {
        $dir = trim((string) env('LEGACY_PUBLIC_DIR', 'public_html'), '/\\');

        return base_path($dir);
    }

    public static function isSeparateFromWebRoot(): bool
    {
        $legacy = realpath(self::root());
        $web = realpath(public_path());

        if ($legacy === false || $web === false) {
            return self::root() !== public_path();
        }

        return $legacy !== $web;
    }

    public static function filePath(string $relativePath): ?string
    {
        if (! self::isSeparateFromWebRoot()) {
            return null;
        }

        $full = self::root().'/'.ltrim(str_replace('\\', '/', $relativePath), '/');

        return is_file($full) ? $full : null;
    }
}
