<?php

namespace OpenCompany\Integrations\Droplr;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class DroplrServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DroplrService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DroplrService(
                accessToken: $creds->get('droplr', 'access_token', ''),
                baseUrl: $creds->get('droplr', 'url', 'https://api.droplr.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DroplrToolProvider());
        }
    }
}
