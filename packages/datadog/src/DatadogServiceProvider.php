<?php

namespace OpenCompany\Integrations\Datadog;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Datadog integration.
 *
 * Registers the DatadogService as a singleton and boots the ToolProvider
 * into the ToolProviderRegistry for auto-discovery.
 */
class DatadogServiceProvider extends ServiceProvider
{
    /**
     * Register the DatadogService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(DatadogService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DatadogService(
                apiKey: $creds->get('datadog', 'api_key', ''),
                appKey: $creds->get('datadog', 'app_key', ''),
                site: $creds->get('datadog', 'site', 'us'),
            );
        });
    }

    /**
     * Boot the service provider and register the Datadog ToolProvider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DatadogToolProvider());
        }
    }
}
