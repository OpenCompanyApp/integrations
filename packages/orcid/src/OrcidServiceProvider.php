<?php

namespace OpenCompany\Integrations\Orcid;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the ORCID integration with Laravel's service container.
 *
 * Binds the public ORCID API service and registers the tool provider with the
 * shared integration registry.
 */
class OrcidServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(OrcidService::class, fn (): OrcidService => new OrcidService);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new OrcidToolProvider);
        }
    }
}
