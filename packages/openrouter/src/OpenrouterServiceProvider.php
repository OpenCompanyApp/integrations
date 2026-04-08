<?php

namespace OpenCompany\Integrations\Openrouter;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the OpenRouter integration.
 *
 * Registers the OpenrouterService as a singleton and bootstraps
 * the tool provider into the ToolProviderRegistry.
 */
class OpenrouterServiceProvider extends ServiceProvider
{
    /**
     * Register the OpenRouter service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(OpenrouterService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new OpenrouterService(
                apiKey: $creds->get('openrouter', 'api_key', ''),
                baseUrl: $creds->get('openrouter', 'url', 'https://openrouter.ai/api/v1'),
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
                ->register(new OpenrouterToolProvider());
        }
    }
}
