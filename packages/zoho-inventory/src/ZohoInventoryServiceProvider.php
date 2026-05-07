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
            $get = static function (string $key, mixed $default = '') use ($creds): mixed {
                $value = $creds->get('zoho-inventory', $key, null);

                return $value !== null && $value !== ''
                    ? $value
                    : $creds->get('zoho_inventory', $key, $default);
            };

            return new ZohoInventoryService(
                accessToken: $get('access_token'),
                organizationId: $get('organization_id'),
                baseUrl: $get('url', 'https://www.zohoapis.com/inventory'),
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
