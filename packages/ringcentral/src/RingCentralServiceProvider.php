<?php

namespace OpenCompany\Integrations\RingCentral;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the RingCentral integration.
 *
 * Registers the RingCentralService singleton and bootstraps the tool provider
 * into the ToolProviderRegistry for auto-discovery.
 */
class RingCentralServiceProvider extends ServiceProvider
{
    /**
     * Register the RingCentral service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(RingCentralService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new RingCentralService(
                accessToken: $creds->get('ringcentral', 'access_token', ''),
                baseUrl: $creds->get('ringcentral', 'url', 'https://platform.ringcentral.com'),
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
                ->register(new RingCentralToolProvider());
        }
    }
}
