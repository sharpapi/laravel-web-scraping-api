<?php

declare(strict_types=1);

namespace SharpAPI\WebScrapingApi;

use Illuminate\Support\ServiceProvider;

/**
 * @api
 */
class WebScrapingApiProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/sharpapi-web-scraping-api.php' => config_path('sharpapi-web-scraping-api.php'),
            ], 'sharpapi-web-scraping-api');
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Merge the package configuration with the app configuration.
        $this->mergeConfigFrom(
            __DIR__.'/../config/sharpapi-web-scraping-api.php', 'sharpapi-web-scraping-api'
        );
    }
}