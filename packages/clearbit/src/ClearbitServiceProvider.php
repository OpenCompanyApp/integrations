<?php

namespace OpenCompany\Integrations\Clearbit;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Clearbit integration with Laravel's service container.
 */
class ClearbitServiceProvider extends ServiceProvider
{
    /**
     * Register the Clearbit service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(ClearbitService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ClearbitService(
                apiKey: $creds->get('clearbit', 'api_key', ''),
                baseUrl: $creds->get('clearbit', 'url', 'https://person.clearbit.com/v2'),
            );
        });
    }

    /**
     * Boot the Clearbit integration by registering the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ClearbitToolProvider());
        }
    }
}
