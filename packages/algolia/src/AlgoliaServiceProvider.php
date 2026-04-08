<?php

namespace OpenCompany\Integrations\Algolia;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Algolia integration.
 *
 * Registers the AlgoliaService singleton and the AlgoliaToolProvider
 * with the ToolProviderRegistry.
 */
class AlgoliaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AlgoliaService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AlgoliaService(
                appId: $creds->get('algolia', 'app_id', ''),
                apiKey: $creds->get('algolia', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AlgoliaToolProvider());
        }
    }
}
