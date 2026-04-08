<?php

namespace OpenCompany\Integrations\Grist;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Grist integration.
 *
 * Registers the GristService singleton and bootstraps the Grist tool provider.
 */
class GristServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GristService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GristService(
                apiKey: $creds->get('grist', 'api_key', ''),
                baseUrl: $creds->get('grist', 'base_url', 'https://docs.getgrist.com/api'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GristToolProvider());
        }
    }
}
