<?php

namespace OpenCompany\Integrations\Mautic;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Mautic integration.
 *
 * Registers the MauticService as a singleton (resolving credentials from the
 * CredentialResolver) and boots the MauticToolProvider into the ToolProviderRegistry.
 */
class MauticServiceProvider extends ServiceProvider
{
    /**
     * Register the MauticService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(MauticService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MauticService(
                username: $creds->get('mautic', 'username', ''),
                password: $creds->get('mautic', 'password', ''),
                baseUrl: $creds->get('mautic', 'hostname', ''),
            );
        });
    }

    /**
     * Boot the service provider — register the tool provider with the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MauticToolProvider());
        }
    }
}
