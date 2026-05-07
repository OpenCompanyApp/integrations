<?php

namespace OpenCompany\Integrations\PubMed;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the PubMed integration with Laravel's service container.
 *
 * Binds the public NCBI E-utilities service and registers the PubMed tool
 * provider with the shared integration registry.
 */
class PubMedServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PubMedService::class, fn (): PubMedService => new PubMedService);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new PubMedToolProvider);
        }
    }
}
