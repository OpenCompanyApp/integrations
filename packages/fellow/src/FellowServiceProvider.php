<?php

namespace OpenCompany\Integrations\Fellow;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Fellow integration with Laravel's service container.
 *
 * Binds the Fellow Developer API client and registers the tool provider.
 */
class FellowServiceProvider extends ServiceProvider
{
    /**
     * Register the FellowService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(FellowService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FellowService(
                apiKey: $creds->get('fellow', 'api_key', $creds->get('fellow', 'access_token', '')),
                subdomain: $creds->get('fellow', 'subdomain', ''),
                baseUrl: $creds->get('fellow', 'url', ''),
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
                ->register(new FellowToolProvider());
        }
    }
}
