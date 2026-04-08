<?php

namespace OpenCompany\Integrations\Keap;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class KeapServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(KeapService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new KeapService(
                accessToken: $creds->get('keap', 'access_token', ''),
                baseUrl: $creds->get('keap', 'url', 'https://api.keap.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new KeapToolProvider());
        }
    }
}
