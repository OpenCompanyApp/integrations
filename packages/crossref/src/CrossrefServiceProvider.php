<?php

namespace OpenCompany\Integrations\Crossref;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Crossref integration with Laravel's service container.
 *
 * Binds the public Crossref service and registers the tool provider with the
 * shared discovery registry.
 */
class CrossrefServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CrossrefService::class, fn (): CrossrefService => new CrossrefService);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new CrossrefToolProvider);
        }
    }
}
