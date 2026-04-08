<?php

namespace OpenCompany\Integrations\Instantly;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Instantly integration with Laravel's service container.
 *
 * Binds InstantlyService as a singleton using credentials from CredentialResolver,
 * and registers the InstantlyToolProvider with the ToolProviderRegistry on boot.
 */
class InstantlyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(InstantlyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new InstantlyService(
                apiKey: $creds->get('instantly', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new InstantlyToolProvider());
        }
    }
}
