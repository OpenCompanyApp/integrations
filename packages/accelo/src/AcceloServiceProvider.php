<?php

namespace OpenCompany\Integrations\Accelo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Accelo integration.
 *
 * Registers the AcceloService singleton with credentials from the
 * CredentialResolver and boots the tool provider into the registry.
 */
class AcceloServiceProvider extends ServiceProvider
{
    /**
     * Register the AcceloService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(AcceloService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AcceloService(
                accessToken: $creds->get('accelo', 'access_token', ''),
                deployment: $creds->get('accelo', 'deployment', ''),
                baseUrl: $creds->get('accelo', 'url', ''),
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
                ->register(new AcceloToolProvider());
        }
    }
}
