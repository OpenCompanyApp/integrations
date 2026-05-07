<?php

namespace OpenCompany\Integrations\CustomerIO;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Customer.io integration with Laravel's service container.
 *
 * Binds CustomerIOService using the host credential resolver and registers the
 * Customer.io tool provider with the shared provider registry.
 */
class CustomerIOServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CustomerIOService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CustomerIOService(
                apiKey: $creds->get('customerio', 'api_key', ''),
                baseUrl: $creds->get('customerio', 'url', 'https://api.customer.io'),
                siteId: $creds->get('customerio', 'site_id', ''),
                trackApiKey: $creds->get('customerio', 'track_api_key', ''),
                trackBaseUrl: $creds->get('customerio', 'track_url', 'https://track.customer.io'),
                pipelinesApiKey: $creds->get('customerio', 'pipelines_api_key', ''),
                pipelinesBaseUrl: $creds->get('customerio', 'pipelines_url', 'https://cdp.customer.io/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CustomerIOToolProvider());
        }
    }
}
