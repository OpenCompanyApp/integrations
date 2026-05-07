<?php

namespace OpenCompany\Integrations\Cohere;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Cohere integration with Laravel's service container.
 *
 * Binds CohereService from configured credentials and registers the tool
 * provider with the shared ToolProviderRegistry when the host exposes it.
 */
class CohereServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CohereService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CohereService(
                apiKey: $creds->get('cohere', 'api_key', ''),
                baseUrl: $creds->get('cohere', 'url', 'https://api.cohere.com'),
                clientName: $creds->get('cohere', 'client_name', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CohereToolProvider());
        }
    }
}
