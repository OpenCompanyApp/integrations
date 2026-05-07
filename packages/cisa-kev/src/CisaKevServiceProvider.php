<?php

namespace OpenCompany\Integrations\CisaKev;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the CISA KEV integration with Laravel's service container.
 *
 * Binds the public CISA KEV feed client and registers the tool provider with
 * the shared ToolProviderRegistry during boot.
 */
class CisaKevServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CisaKevService::class, fn (): CisaKevService => new CisaKevService);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new CisaKevToolProvider);
        }
    }
}
