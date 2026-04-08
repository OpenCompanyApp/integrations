<?php

namespace OpenCompany\Integrations\Crisp;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * CrispServiceProvider — Laravel service provider for the Crisp integration.
 *
 * Registers the CrispService singleton and auto-discovers the tool provider
 * via the ToolProviderRegistry.
 */
class CrispServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CrispService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CrispService(
                apiKey: $creds->get('crisp', 'api_key', ''),
                websiteId: $creds->get('crisp', 'website_id', ''),
                baseUrl: $creds->get('crisp', 'url', 'https://api.crisp.chat/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CrispToolProvider());
        }
    }
}
