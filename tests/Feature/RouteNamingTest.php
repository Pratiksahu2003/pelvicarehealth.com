<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class RouteNamingTest extends TestCase
{
    public function test_route_names_are_unique_for_caching(): void
    {
        $names = [];
        foreach (app('router')->getRoutes() as $route) {
            $name = $route->getName();
            if ($name === null) {
                continue;
            }

            $this->assertArrayNotHasKey(
                $name,
                $names,
                "Duplicate route name [{$name}] on URI [{$route->uri()}]"
            );
            $names[$name] = $route->uri();
        }
    }

    public function test_routes_can_be_cached(): void
    {
        Artisan::call('route:cache');
        $this->addToAssertionCount(1);

        Artisan::call('route:clear');
    }
}
