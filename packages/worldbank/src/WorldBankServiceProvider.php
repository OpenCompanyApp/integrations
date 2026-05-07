<?php

namespace OpenCompany\Integrations\WorldBank;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the World Bank integration with Laravel.
 *
 * Binds the public API service and registers the tool provider when a registry is available.
 */
class WorldBankServiceProvider extends ServiceProvider
{
    /**
     * Register the World Bank API service.
     */
    public function register(): void
    {
        $this->app->singleton(WorldBankService::class);
    }

    /**
     * Register World Bank tools with the shared provider registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new WorldBankToolProvider());
        }
    }
}
