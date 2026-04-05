<?php

namespace OpenCompany\Integrations\Coda;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Coda integration.
 *
 * Registers the CodaService singleton and boots the CodaToolProvider
 * into the ToolProviderRegistry for auto-discovery.
 */
class CodaServiceProvider extends ServiceProvider
{
    /**
     * Register the CodaService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(CodaService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CodaService(
                apiKey: $creds->get('coda', 'api_token', ''),
            );
        });
    }

    /**
     * Boot the CodaToolProvider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CodaToolProvider());
        }
    }
}
