<?php

namespace OpenCompany\Integrations\Asana;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Asana integration.
 *
 * Registers the AsanaService singleton and bootstraps the Asana tool provider.
 */
class AsanaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AsanaService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AsanaService(
                accessToken: $creds->get('asana', 'access_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AsanaToolProvider());
        }
    }
}
