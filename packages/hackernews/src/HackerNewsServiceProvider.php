<?php

namespace OpenCompany\Integrations\HackerNews;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Hacker News integration.
 *
 * Registers the HackerNewsService singleton and the HackerNewsToolProvider
 * with the ToolProviderRegistry. No credentials are needed — the HN API
 * is fully public.
 */
class HackerNewsServiceProvider extends ServiceProvider
{
    /**
     * Register the HackerNewsService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(HackerNewsService::class, function ($app) {
            $baseUrl = config('services.hackernews.url', 'https://hacker-news.firebaseio.com/v0');

            return new HackerNewsService(
                baseUrl: $baseUrl,
            );
        });
    }

    /**
     * Boot the service provider — register tools with the ToolProviderRegistry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new HackerNewsToolProvider());
        }
    }
}
