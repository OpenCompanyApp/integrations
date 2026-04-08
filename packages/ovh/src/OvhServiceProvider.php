<?php

namespace OpenCompany\Integrations\Ovh;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class OvhServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(OvhService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new OvhService(
                accessToken: $creds->get('ovh', 'access_token', ''),
                baseUrl: $creds->get('ovh', 'url', 'https://eu.api.ovh.com/1.0'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new OvhToolProvider());
        }
    }
}
