<?php

namespace OpenCompany\Integrations\Braintrust;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Braintrust integration with Laravel's service container.
 *
 * Binds BraintrustService from configured credentials and registers the tool
 * provider with the shared ToolProviderRegistry when available.
 */
class BraintrustServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BraintrustService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BraintrustService(
                apiKey: $creds->get('braintrust', 'api_key', ''),
                baseUrl: $creds->get('braintrust', 'base_url', 'https://api.braintrust.dev'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BraintrustToolProvider());
        }
    }
}
