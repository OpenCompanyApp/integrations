<?php

namespace OpenCompany\Integrations\Lob;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class LobServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LobService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LobService(
                apiKey: $creds->get('lob', 'api_key', ''),
                baseUrl: $creds->get('lob', 'url', 'https://api.lob.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new LobToolProvider());
        }
    }
}
