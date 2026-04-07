<?php

namespace OpenCompany\Integrations\Neon;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class NeonServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(NeonService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new NeonService(
                accessToken: $creds->get('neon', 'access_token', ''),
                baseUrl: $creds->get('neon', 'url', 'https://console.neon.tech/api/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new NeonToolProvider());
        }
    }
}
