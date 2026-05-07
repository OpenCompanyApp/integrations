<?php

namespace OpenCompany\Integrations\DepsDev;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the deps.dev integration with Laravel's service container.
 *
 * Binds the public deps.dev API client and registers the tool provider with the
 * shared ToolProviderRegistry during boot.
 */
class DepsDevServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DepsDevService::class, fn (): DepsDevService => new DepsDevService);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new DepsDevToolProvider);
        }
    }
}
