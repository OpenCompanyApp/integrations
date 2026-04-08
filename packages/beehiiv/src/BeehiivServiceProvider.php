<?php

namespace OpenCompany\Integrations\Beehiiv;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Beehiiv integration.
 *
 * Registers the BeehiivService as a singleton and boots the tool provider
 * into the ToolProviderRegistry.
 */
class BeehiivServiceProvider extends ServiceProvider
{
    /**
     * Register the BeehiivService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(BeehiivService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BeehiivService(
                apiKey: $creds->get('beehiiv', 'api_key', ''),
                publicationId: $creds->get('beehiiv', 'publication_id', ''),
            );
        });
    }

    /**
     * Boot the Beehiiv tool provider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BeehiivToolProvider());
        }
    }
}
