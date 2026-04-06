<?php

namespace OpenCompany\Integrations\HeyGen;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class HeyGenServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(HeyGenService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new HeyGenService(
                accessToken: $creds->get('heygen', 'access_token', ''),
                baseUrl: $creds->get('heygen', 'url', 'https://api.heygen.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new HeyGenToolProvider());
        }
    }
}
