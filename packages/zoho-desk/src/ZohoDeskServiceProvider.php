<?php

namespace OpenCompany\Integrations\ZohoDesk;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Zoho Desk integration.
 *
 * Registers the ZohoDeskService singleton with credentials from the
 * CredentialResolver and bootstraps the ToolProvider into the registry.
 */
class ZohoDeskServiceProvider extends ServiceProvider
{
    /**
     * Register the ZohoDeskService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ZohoDeskService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ZohoDeskService(
                accessToken: $creds->get('zoho-desk', 'access_token', ''),
                baseUrl: $creds->get('zoho-desk', 'base_url', 'https://desk.zoho.com/api/v1'),
                orgId: $creds->get('zoho-desk', 'org_id', ''),
            );
        });
    }

    /**
     * Boot the service provider — register the tool provider if the registry is bound.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ZohoDeskToolProvider());
        }
    }
}
