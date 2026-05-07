<?php

namespace OpenCompany\Integrations\ClinicalTrialsGov;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the ClinicalTrials.gov integration with Laravel's service container.
 *
 * Binds the public API service and registers the tool provider with the shared
 * integration registry.
 */
class ClinicalTrialsGovServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ClinicalTrialsGovService::class, fn (): ClinicalTrialsGovService => new ClinicalTrialsGovService);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new ClinicalTrialsGovToolProvider);
        }
    }
}
