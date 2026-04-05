<?php

namespace OpenCompany\Integrations\Attio;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class AttioServiceProvider extends ServiceProvider
{
    /**
     * Register the Attio service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(AttioService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AttioService(
                apiKey: $creds->get('attio', 'api_key', ''),
                baseUrl: $creds->get('attio', 'url', 'https://api.attio.com/v2'),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AttioToolProvider());
        }
    }
}
