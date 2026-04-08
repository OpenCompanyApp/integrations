<?php

namespace OpenCompany\Integrations\Hootsuite;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class HootsuiteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(HootsuiteService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new HootsuiteService(
                accessToken: $creds->get('hootsuite', 'access_token', ''),
                baseUrl: $creds->get('hootsuite', 'url', 'https://platform.hootsuite.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new HootsuiteToolProvider());
        }
    }
}
