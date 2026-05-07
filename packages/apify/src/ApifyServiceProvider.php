<?php

namespace OpenCompany\Integrations\Apify;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Apify integration with Laravel's service container.
 *
 * Binds ApifyService as a singleton using host-provided credentials and
 * registers the ApifyToolProvider with the ToolProviderRegistry on boot.
 */
class ApifyServiceProvider extends ServiceProvider
{
    /**
     * Register the Apify API client singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ApifyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ApifyService(
                apiToken: $creds->get('apify', 'api_token', ''),
                baseUrl: $creds->get('apify', 'url', 'https://api.apify.com'),
            );
        });
    }

    /**
     * Boot the Apify tool provider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ApifyToolProvider());
        }
    }
}
