<?php

namespace OpenCompany\Integrations\ApiTemplateIO;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the API Template IO integration.
 *
 * Registers the ApiTemplateIOService as a singleton and boots the tool provider
 * into the ToolProviderRegistry for auto-discovery.
 */
class ApiTemplateIOServiceProvider extends ServiceProvider
{
    /**
     * Register the ApiTemplateIOService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ApiTemplateIOService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ApiTemplateIOService(
                apiKey: $creds->get('apitemplateio', 'api_key', ''),
                baseUrl: $creds->get('apitemplateio', 'url', 'https://api.apitemplate.io/v1'),
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
                ->register(new ApiTemplateIOToolProvider());
        }
    }
}
