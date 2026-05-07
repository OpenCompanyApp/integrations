<?php

namespace OpenCompany\Integrations\ExchangeRate;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the public ExchangeRate integration with Laravel.
 *
 * Binds the stateless service and registers the tool provider when the registry is available.
 */
class ExchangeRateServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ExchangeRateService::class);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ExchangeRateToolProvider());
        }
    }
}
