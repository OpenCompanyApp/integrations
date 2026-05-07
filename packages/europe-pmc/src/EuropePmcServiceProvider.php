<?php

namespace OpenCompany\Integrations\EuropePmc;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Europe PMC integration with Laravel's service container.
 *
 * Binds the public Europe PMC service and registers the tool provider with the
 * shared discovery registry.
 */
class EuropePmcServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(EuropePmcService::class, fn (): EuropePmcService => new EuropePmcService);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new EuropePmcToolProvider);
        }
    }
}
