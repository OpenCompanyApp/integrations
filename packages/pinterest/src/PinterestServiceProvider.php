<?php

namespace OpenCompany\Integrations\Pinterest;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class PinterestServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PinterestService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PinterestService(
                accessToken: $creds->get('pinterest', 'access_token', ''),
                baseUrl: $creds->get('pinterest', 'url', 'https://api.pinterest.com/v5'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PinterestToolProvider());
        }
    }
}
