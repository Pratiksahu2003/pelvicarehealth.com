<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class FreshEnvBootstrapTest extends TestCase
{
    public function test_removes_config_cache_when_env_is_newer(): void
    {
        $base = sys_get_temp_dir().'/laravel-fresh-env-'.uniqid('', true);
        mkdir($base.'/bootstrap/cache', 0777, true);

        $env = $base.'/.env';
        $config = $base.'/bootstrap/cache/config.php';

        file_put_contents($config, '<?php return [];');
        touch($config, time() - 100);
        file_put_contents($env, "APP_NAME=Laravel\nDB_DATABASE=test\n");

        $this->runFreshEnvScript($base);

        $this->assertFileDoesNotExist($config);

        $this->removeDirectory($base);
    }

    public function test_read_env_from_dotenv_removes_config_cache_even_when_env_is_older(): void
    {
        $base = sys_get_temp_dir().'/laravel-fresh-env-'.uniqid('', true);
        mkdir($base.'/bootstrap/cache', 0777, true);

        $env = $base.'/.env';
        $config = $base.'/bootstrap/cache/config.php';

        file_put_contents($env, "READ_ENV_FROM_DOTENV=true\n");
        touch($env, time() - 100);
        file_put_contents($config, '<?php return [];');
        touch($config, time());

        $this->runFreshEnvScript($base);

        $this->assertFileDoesNotExist($config);

        $this->removeDirectory($base);
    }

    private function runFreshEnvScript(string $base): void
    {
        $originalDir = getcwd();
        chdir(dirname(__DIR__, 2));

        $closure = (static function () use ($base): void {
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
        });

        $closure();
        chdir($originalDir);
    }

    private function removeDirectory(string $dir): void
    {
        if (! is_dir($dir)) {
            return;
        }

        foreach (scandir($dir) ?: [] as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }
            $path = $dir.'/'.$item;
            is_dir($path) ? $this->removeDirectory($path) : unlink($path);
        }

        rmdir($dir);
    }
}
