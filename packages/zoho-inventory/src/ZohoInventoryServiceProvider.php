<?php

namespace OpenCompany\Integrations\ZohoInventory;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ZohoInventoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ZohoInventoryService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ZohoInventoryService(
                accessToken: $creds->get('zoho_inventory', 'access_token', ''),
                organizationId: $creds->get('zoho_inventory', 'organization_id', ''),
                baseUrl: $creds->get('zoho_inventory', 'url', 'https://www.zohoapis.com/inventory'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ZohoInventoryToolProvider());
        }
    }
}
