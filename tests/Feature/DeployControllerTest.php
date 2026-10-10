<?php

namespace Tests\Feature;

use Tests\TestCase;

class DeployControllerTest extends TestCase
{
    public function test_deploy_run_requires_token_configuration(): void
    {
        config(['deploy.token' => '']);

        $this->get('/deploy/run?token=anything')
            ->assertForbidden()
            ->assertJson(['status' => 'error']);
    }

    public function test_deploy_run_rejects_wrong_token(): void
    {
        config(['deploy.token' => 'correct-secret']);

        $this->get('/deploy/run?token=wrong')
            ->assertForbidden();
    }
}
