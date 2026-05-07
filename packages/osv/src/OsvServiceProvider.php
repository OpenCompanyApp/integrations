<?php

namespace OpenCompany\Integrations\Osv;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the OSV integration with Laravel's service container.
 *
 * Binds the no-auth OSV API client and registers the OSV tool provider with
 * the shared ToolProviderRegistry during boot.
 */
class OsvServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(OsvService::class, fn (): OsvService => new OsvService);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new OsvToolProvider);
        }
    }
}
