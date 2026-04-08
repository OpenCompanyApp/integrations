<?php

namespace OpenCompany\Integrations\Bubble;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Bubble integration.
 *
 * Registers the BubbleService as a singleton and boots the
 * BubbleToolProvider into the ToolProviderRegistry.
 */
class BubbleServiceProvider extends ServiceProvider
{
    /**
     * Register the BubbleService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(BubbleService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BubbleService(
                apiKey: $creds->get('bubble', 'api_key', ''),
                baseUrl: $creds->get('bubble', 'hostname', ''),
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
                ->register(new BubbleToolProvider());
        }
    }
}
