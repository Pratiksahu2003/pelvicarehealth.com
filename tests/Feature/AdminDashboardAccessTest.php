<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminDashboardAccessTest extends TestCase
{
    public function test_guest_is_redirected_to_login_from_admin(): void
    {
        $this->get('/admin')
            ->assertRedirect(route('login'));
    }
}
