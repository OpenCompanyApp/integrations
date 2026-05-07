<?php

namespace OpenCompany\Integrations\Brandfetch;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class BrandfetchServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BrandfetchService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BrandfetchService(
                accessToken: $creds->get('brandfetch', 'access_token', ''),
                baseUrl: $creds->get('brandfetch', 'url', 'https://api.brandfetch.io'),
                clientId: $creds->get('brandfetch', 'client_id', ''),
                cdnUrl: $creds->get('brandfetch', 'cdn_url', 'https://cdn.brandfetch.io'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BrandfetchToolProvider());
        }
    }
}
