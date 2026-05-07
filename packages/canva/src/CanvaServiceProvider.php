<?php

namespace OpenCompany\Integrations\Canva;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Canva integration with Laravel's service container.
 *
 * Binds CanvaService with credentials from CredentialResolver and registers the
 * CanvaToolProvider when the host exposes a ToolProviderRegistry.
 */
class CanvaServiceProvider extends ServiceProvider
{
    /**
     * Register the Canva API client.
     */
    public function register(): void
    {
        $this->app->singleton(CanvaService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CanvaService(
                accessToken: $creds->get('canva', 'access_token', ''),
                baseUrl: $creds->get('canva', 'url', 'https://api.canva.com/rest'),
                clientId: $creds->get('canva', 'client_id', ''),
                clientSecret: $creds->get('canva', 'client_secret', ''),
            );
        });
    }

    /**
     * Register the Canva tool provider with the host registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CanvaToolProvider());
        }
    }
}
