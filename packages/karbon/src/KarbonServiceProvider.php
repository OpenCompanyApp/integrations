<?php

namespace OpenCompany\Integrations\Karbon;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class KarbonServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(KarbonService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new KarbonService(
                accessToken: $creds->get('karbon', 'access_token', ''),
                baseUrl: $creds->get('karbon', 'url', 'https://api.karbonhq.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new KarbonToolProvider());
        }
    }
}
