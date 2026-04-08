<?php

namespace OpenCompany\Integrations\Hubstaff;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class HubstaffServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(HubstaffService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new HubstaffService(
                accessToken: $creds->get('hubstaff', 'access_token', ''),
                baseUrl: $creds->get('hubstaff', 'url', 'https://api.hubstaff.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new HubstaffToolProvider());
        }
    }
}
