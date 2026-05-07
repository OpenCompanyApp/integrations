<?php

namespace OpenCompany\Integrations\SecEdgar;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the SEC EDGAR integration with Laravel's service container.
 *
 * Binds the public SEC EDGAR service and registers the tool provider with the
 * shared discovery registry.
 */
class SecEdgarServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SecEdgarService::class, fn (): SecEdgarService => new SecEdgarService);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new SecEdgarToolProvider);
        }
    }
}
