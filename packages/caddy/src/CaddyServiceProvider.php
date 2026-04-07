<?php

namespace OpenCompany\Integrations\Caddy;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class CaddyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CaddyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CaddyService(
                accessToken: $creds->get('caddy', 'access_token', ''),
                baseUrl: $creds->get('caddy', 'url', 'https://api.caddyserver.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CaddyToolProvider());
        }
    }
}
