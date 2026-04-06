<?php

namespace OpenCompany\Integrations\ConvertKit;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the ConvertKit integration.
 *
 * Registers the ConvertKitService as a singleton (resolving default credentials)
 * and boots the tool provider into the ToolProviderRegistry.
 */
class ConvertKitServiceProvider extends ServiceProvider
{
    /**
     * Register the ConvertKitService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ConvertKitService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ConvertKitService(
                apiKey: $creds->get('convertkit', 'api_key', ''),
                baseUrl: $creds->get('convertkit', 'url', 'https://api.convertkit.com'),
            );
        });
    }

    /**
     * Boot the ConvertKit tool provider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ConvertKitToolProvider());
        }
    }
}
