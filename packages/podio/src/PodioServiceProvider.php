<?php

namespace OpenCompany\Integrations\Podio;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class PodioServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PodioService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PodioService(
                accessToken: $creds->get('podio', 'access_token', ''),
                baseUrl: $creds->get('podio', 'url', 'https://api.podio.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PodioToolProvider());
        }
    }
}
