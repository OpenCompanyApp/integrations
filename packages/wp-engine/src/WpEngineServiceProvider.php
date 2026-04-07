<?php

namespace OpenCompany\Integrations\WpEngine;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class WpEngineServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(WpEngineService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WpEngineService(
                accessToken: $creds->get('wp_engine', 'access_token', ''),
                baseUrl: $creds->get('wp_engine', 'url', 'https://api.wpengineapi.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new WpEngineToolProvider());
        }
    }
}
