<?php

namespace OpenCompany\Integrations\Agora;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class AgoraServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AgoraService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AgoraService(
                apiKey: $creds->get('agora', 'api_key', ''),
                baseUrl: $creds->get('agora', 'url', 'https://api.agora.io/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AgoraToolProvider());
        }
    }
}
