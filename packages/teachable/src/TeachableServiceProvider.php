<?php

namespace OpenCompany\Integrations\Teachable;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Teachable integration.
 *
 * Registers the TeachableService as a singleton and boots the tool provider
 * into the ToolProviderRegistry.
 */
class TeachableServiceProvider extends ServiceProvider
{
    /**
     * Register the TeachableService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(TeachableService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TeachableService(
                apiKey: $creds->get('teachable', 'api_key', ''),
            );
        });
    }

    /**
     * Boot the Teachable tool provider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TeachableToolProvider());
        }
    }
}
