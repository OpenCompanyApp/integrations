<?php

namespace OpenCompany\Integrations\Freshteam;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class FreshteamServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FreshteamService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FreshteamService(
                accessToken: $creds->get('freshteam', 'access_token', ''),
                domain: $creds->get('freshteam', 'domain', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FreshteamToolProvider());
        }
    }
}
