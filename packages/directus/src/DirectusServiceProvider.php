<?php

namespace OpenCompany\Integrations\Directus;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class DirectusServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DirectusService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DirectusService(
                accessToken: $creds->get('directus', 'access_token', ''),
                baseUrl: $creds->get('directus', 'url', 'https://directus.example.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DirectusToolProvider());
        }
    }
}
