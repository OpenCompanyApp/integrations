<?php

namespace OpenCompany\Integrations\Kamatera;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class KamateraServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(KamateraService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new KamateraService(
                accessToken: $creds->get('kamatera', 'access_token', ''),
                baseUrl: $creds->get('kamatera', 'url', 'https://cloudcli.kamatera.com/api'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new KamateraToolProvider());
        }
    }
}
