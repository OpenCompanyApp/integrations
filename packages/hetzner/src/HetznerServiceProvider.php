<?php

namespace OpenCompany\Integrations\Hetzner;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class HetznerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(HetznerService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new HetznerService(
                accessToken: $creds->get('hetzner', 'access_token', ''),
                baseUrl: $creds->get('hetzner', 'url', 'https://api.hetzner.cloud/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new HetznerToolProvider());
        }
    }
}
