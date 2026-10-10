<?php

namespace App\Providers;

use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->usePublicPath(
            base_path(trim((string) env('PUBLIC_DIR_NAME', 'public_html'), '/\\'))
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['layouts.app', 'partials.search-bar'], function ($view) {
            try {
                $navCategories = Cache::remember('nav.service_categories', 3600, function () {
                    return ServiceCategory::active()->ordered()->get();
                });
            } catch (\Throwable) {
                $navCategories = collect();
            }

            $view->with('navCategories', $navCategories);
        });
    }
}
