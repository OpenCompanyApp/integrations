<?php

namespace OpenCompany\Integrations\Dub;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class DubServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DubService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DubService(
                accessToken: $creds->get('dub', 'access_token', ''),
                baseUrl: $creds->get('dub', 'base_url', 'https://api.dub.co'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DubToolProvider());
        }
    }
}
