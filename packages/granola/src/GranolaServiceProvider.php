<?php

namespace OpenCompany\Integrations\Granola;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Granola integration with Laravel's service container.
 *
 * Binds the Granola Enterprise API client and registers the tool provider when
 * the host application exposes the integration registry.
 */
class GranolaServiceProvider extends ServiceProvider
{
    /**
     * Register the Granola API service singleton.
     */
    public function register(): void
    {
        $this->app->singleton(GranolaService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GranolaService(
                apiKey: $creds->get('granola', 'api_key', ''),
                baseUrl: $creds->get('granola', 'url', 'https://public-api.granola.ai/v1'),
            );
        });
    }

    /**
     * Register the Granola tool provider with the shared registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GranolaToolProvider());
        }
    }
}
