<?php

namespace OpenCompany\Integrations\Raindrop;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class RaindropServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(RaindropService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new RaindropService(
                accessToken: $creds->get('raindrop', 'access_token', ''),
                baseUrl: $creds->get('raindrop', 'url', 'https://api.raindrop.io/rest/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new RaindropToolProvider());
        }
    }
}
