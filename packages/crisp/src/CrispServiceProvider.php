<?php

namespace OpenCompany\Integrations\Crisp;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Crisp integration with Laravel's service container.
 *
 * Binds CrispService using token identifier/key credentials and registers
 * CrispToolProvider with the shared ToolProviderRegistry when available.
 */
class CrispServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CrispService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CrispService(
                identifier: $creds->get('crisp', 'identifier', $creds->get('crisp', 'api_key', '')),
                key: $creds->get('crisp', 'key', $creds->get('crisp', 'token_key', '')),
                websiteId: $creds->get('crisp', 'website_id', ''),
                tier: $creds->get('crisp', 'tier', 'plugin'),
                baseUrl: $creds->get('crisp', 'url', 'https://api.crisp.chat'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new CrispToolProvider());
        }
    }
}
