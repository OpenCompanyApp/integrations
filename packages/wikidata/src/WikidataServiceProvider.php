<?php

namespace OpenCompany\Integrations\Wikidata;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Wikidata integration with Laravel's service container.
 *
 * Binds the public API client and registers the tool provider with the shared
 * ToolProviderRegistry during boot.
 */
class WikidataServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(WikidataService::class, fn (): WikidataService => new WikidataService);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new WikidataToolProvider);
        }
    }
}
