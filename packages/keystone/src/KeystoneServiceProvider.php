<?php

namespace OpenCompany\Integrations\Keystone;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class KeystoneServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(KeystoneService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new KeystoneService(
                accessToken: $creds->get('keystone', 'access_token', ''),
                baseUrl: $creds->get('keystone', 'url', 'https://api.keystonejs.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new KeystoneToolProvider());
        }
    }
}
