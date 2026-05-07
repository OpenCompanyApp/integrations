<?php

namespace OpenCompany\Integrations\Ipstack;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the IPstack integration with Laravel.
 *
 * Binds the API client from configured credentials and registers the provider
 * with the shared integration registry.
 */
class IpstackServiceProvider extends ServiceProvider
{
    /**
     * Register the IPstack service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(IpstackService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new IpstackService(
                apiKey: $creds->get('ipstack', 'api_key', ''),
                baseUrl: $creds->get('ipstack', 'url', 'https://api.ipstack.com'),
            );
        });
    }

    /**
     * Boot the IPstack integration by registering the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new IpstackToolProvider());
        }
    }
}
