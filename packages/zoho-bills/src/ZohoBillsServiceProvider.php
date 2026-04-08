<?php

namespace OpenCompany\Integrations\ZohoBills;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ZohoBillsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ZohoBillsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ZohoBillsService(
                accessToken: $creds->get('zoho_bills', 'access_token', ''),
                organizationId: $creds->get('zoho_bills', 'organization_id', ''),
                baseUrl: $creds->get('zoho_bills', 'url', 'https://billing.zoho.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ZohoBillsToolProvider());
        }
    }
}
