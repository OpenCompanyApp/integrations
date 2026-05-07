<?php

namespace OpenCompany\Integrations\BlandAI;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the BlandAI integration.
 *
 * Registers the BlandAIService singleton and boots the tool provider
 * into the ToolProviderRegistry when available.
 */
class BlandAIServiceProvider extends ServiceProvider
{
    /**
     * Register the BlandAIService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(BlandAIService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BlandAIService(
                apiKey: $creds->get('blandai', 'api_key', ''),
                baseUrl: $creds->get('blandai', 'url', 'https://api.bland.ai'),
            );
        });
    }

    /**
     * Boot the service provider — register the tool provider with the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BlandAIToolProvider());
        }
    }
}
