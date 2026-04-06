<?php

namespace OpenCompany\Integrations\Beamer;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class BeamerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BeamerService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BeamerService(
                apiKey: $creds->get('beamer', 'api_key', ''),
                baseUrl: $creds->get('beamer', 'url', 'https://api.getbeamer.com/v0'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BeamerToolProvider());
        }
    }
}
