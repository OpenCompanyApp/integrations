<?php

namespace OpenCompany\Integrations\Lokalise;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class LokaliseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LokaliseService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LokaliseService(
                apiToken: $creds->get('lokalise', 'api_token', ''),
                baseUrl: $creds->get('lokalise', 'base_url', 'https://api.lokalise.com/api2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new LokaliseToolProvider());
        }
    }
}
