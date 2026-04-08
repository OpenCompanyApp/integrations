<?php

namespace OpenCompany\Integrations\Missive;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Missive integration.
 *
 * Registers the MissiveService as a singleton and boots the ToolProvider
 * into the ToolProviderRegistry when available.
 */
class MissiveServiceProvider extends ServiceProvider
{
    /**
     * Register the MissiveService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(MissiveService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MissiveService(
                accessToken: $creds->get('missive', 'access_token', ''),
                baseUrl: $creds->get('missive', 'url', 'https://public.missiveapp.com/v1'),
            );
        });
    }

    /**
     * Boot the service provider — register the ToolProvider with the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MissiveToolProvider());
        }
    }
}
