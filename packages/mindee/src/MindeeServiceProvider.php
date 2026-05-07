<?php

namespace OpenCompany\Integrations\Mindee;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Mindee document OCR integration.
 *
 * Registers the MindeeService as a singleton and bootstraps the tool provider
 * into the ToolProviderRegistry for auto-discovery.
 */
class MindeeServiceProvider extends ServiceProvider
{
    /**
     * Register the MindeeService singleton with configured credentials.
     */
    public function register(): void
    {
        $this->app->singleton(MindeeService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MindeeService(
                apiKey: $creds->get('mindee', 'api_key', ''),
                baseUrl: $creds->get('mindee', 'url', 'https://api.mindee.net/v1'),
            );
        });
    }

    /**
     * Boot the service provider and register tools with the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MindeeToolProvider());
        }
    }
}
