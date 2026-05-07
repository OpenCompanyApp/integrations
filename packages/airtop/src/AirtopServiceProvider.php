<?php

namespace OpenCompany\Integrations\Airtop;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Airtop integration with Laravel's service container.
 *
 * Binds AirtopService as a singleton using host-provided credentials and
 * registers the AirtopToolProvider with the ToolProviderRegistry on boot.
 */
class AirtopServiceProvider extends ServiceProvider
{
    /**
     * Register the Airtop API client singleton.
     */
    public function register(): void
    {
        $this->app->singleton(AirtopService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AirtopService(
                apiKey: $creds->get('airtop', 'api_key', ''),
                baseUrl: $creds->get('airtop', 'url', 'https://api.airtop.ai/api'),
            );
        });
    }

    /**
     * Boot the Airtop tool provider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AirtopToolProvider());
        }
    }
}
