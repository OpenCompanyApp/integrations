<?php

namespace OpenCompany\Integrations\Mux;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Mux integration.
 *
 * Registers the MuxService singleton and boots the tool provider
 * into the ToolProviderRegistry when available.
 */
class MuxServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MuxService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MuxService(
                accessToken: $creds->get('mux', 'access_token', ''),
                baseUrl: $creds->get('mux', 'url', 'https://api.mux.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MuxToolProvider());
        }
    }
}
