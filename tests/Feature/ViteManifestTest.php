<?php

namespace Tests\Feature;

use Tests\TestCase;

class ViteManifestTest extends TestCase
{
    public function test_vite_manifest_lives_under_public_path(): void
    {
        $manifest = public_path('build/manifest.json');

        $this->assertFileExists(
            $manifest,
            'Run npm run build and deploy public/build (Hostinger has no Vite dev server in production).'
        );

        $this->assertIsArray(json_decode((string) file_get_contents($manifest), true));
    }
}
