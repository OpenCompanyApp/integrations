<?php

namespace OpenCompany\Integrations\Railway;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class RailwayServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(RailwayService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new RailwayService(
                accessToken: $creds->get('railway', 'access_token', ''),
                baseUrl: $creds->get('railway', 'url', 'https://backboard.railway.app/graphql/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new RailwayToolProvider());
        }
    }
}
