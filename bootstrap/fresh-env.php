<?php

/**
 * Ensures Laravel reads the current .env (Hostinger: no SSH after editing DB_* in File Manager).
 * Must run before bootstrap/app.php loads cached config.
 */
(function (): void {
    $base = dirname(__DIR__);
    $cachedConfig = $base.'/bootstrap/cache/config.php';
    $envFile = $base.'/.env';

    if (! is_file($cachedConfig)) {
        return;
    }

    $alwaysReadEnv = false;
    if (is_readable($envFile)) {
        foreach (file($envFile, FILE_IGNORE_NEW_LINES) ?: [] as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }
            if (preg_match('/^READ_ENV_FROM_DOTENV=(.*)$/', $line, $matches)) {
                $value = strtolower(trim($matches[1], " \t\"'"));
                $alwaysReadEnv = in_array($value, ['1', 'true', 'yes', 'on'], true);
                break;
            }
        }
    }

    $envIsNewer = is_file($envFile) && filemtime($envFile) > filemtime($cachedConfig);

    if ($alwaysReadEnv || $envIsNewer) {
        @unlink($cachedConfig);
    }
})();
