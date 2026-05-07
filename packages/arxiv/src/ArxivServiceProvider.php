<?php

namespace OpenCompany\Integrations\Arxiv;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the arXiv integration with Laravel's service container.
 *
 * Binds the public arXiv API service and registers the arXiv tool provider
 * with the shared discovery registry.
 */
class ArxivServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ArxivService::class, fn (): ArxivService => new ArxivService);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new ArxivToolProvider);
        }
    }
}
