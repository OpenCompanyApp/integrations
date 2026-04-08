<?php

namespace OpenCompany\Integrations\QuickBase;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class QuickBaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(QuickBaseService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new QuickBaseService(
                accessToken: $creds->get('quickbase', 'access_token', ''),
                realmHostname: $creds->get('quickbase', 'realm_hostname', ''),
                baseUrl: $creds->get('quickbase', 'base_url', 'https://api.quickbase.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new QuickBaseToolProvider());
        }
    }
}
