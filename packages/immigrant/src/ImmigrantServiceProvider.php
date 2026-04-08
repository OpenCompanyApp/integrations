<?php

namespace OpenCompany\Integrations\Immigrant;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Immigrant integration.
 *
 * Registers the ImmigrantService singleton with credentials from the
 * CredentialResolver and boots the tool provider into the registry.
 */
class ImmigrantServiceProvider extends ServiceProvider
{
    /**
     * Register the ImmigrantService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ImmigrantService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ImmigrantService(
                accessToken: $creds->get('immigrant', 'access_token', ''),
                baseUrl: $creds->get('immigrant', 'url', 'https://api.immigration.com/v1'),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ImmigrantToolProvider());
        }
    }
}
