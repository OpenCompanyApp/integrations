<?php

namespace OpenCompany\Integrations\ZohoDesk;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ZohoDeskServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ZohoDeskService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ZohoDeskService(
                accessToken: $creds->get('zoho-desk', 'access_token', ''),
                baseUrl: $creds->get('zoho-desk', 'url', 'https://desk.zoho.com/api/v1'),
                orgId: $creds->get('zoho-desk', 'org_id', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ZohoDeskToolProvider());
        }
    }
}
