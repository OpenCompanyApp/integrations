<?php

namespace OpenCompany\Integrations\FirstEpss;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the FIRST EPSS integration with Laravel's service container.
 *
 * Binds the public EPSS API client and registers the tool provider with the
 * shared ToolProviderRegistry during boot.
 */
class FirstEpssServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FirstEpssService::class, fn (): FirstEpssService => new FirstEpssService);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new FirstEpssToolProvider);
        }
    }
}
