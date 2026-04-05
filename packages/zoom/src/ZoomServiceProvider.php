<?php

namespace OpenCompany\Integrations\Zoom;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Zoom integration.
 *
 * Registers the ZoomService singleton and bootstraps the Zoom tool provider.
 */
class ZoomServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ZoomService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ZoomService(
                accessToken: $creds->get('zoom', 'access_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ZoomToolProvider());
        }
    }
}
