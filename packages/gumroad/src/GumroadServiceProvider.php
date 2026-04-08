<?php

namespace OpenCompany\Integrations\Gumroad;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class GumroadServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GumroadService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GumroadService(
                accessToken: $creds->get('gumroad', 'access_token', ''),
                baseUrl: $creds->get('gumroad', 'url', 'https://api.gumroad.com/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GumroadToolProvider());
        }
    }
}
