<?php

namespace OpenCompany\Integrations\AssemblyAI;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the AssemblyAI integration.
 *
 * Registers the AssemblyAIService as a singleton and bootstraps
 * the tool provider into the ToolProviderRegistry.
 */
class AssemblyAIServiceProvider extends ServiceProvider
{
    /**
     * Register the AssemblyAI service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(AssemblyAIService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AssemblyAIService(
                apiKey: $creds->get('assemblyai', 'api_key', ''),
                baseUrl: $creds->get('assemblyai', 'url', 'https://api.assemblyai.com/v2'),
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
                ->register(new AssemblyAIToolProvider());
        }
    }
}
