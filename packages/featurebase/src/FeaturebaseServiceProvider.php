<?php

namespace OpenCompany\Integrations\Featurebase;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Featurebase integration with Laravel.
 *
 * Binds the Featurebase API client from host credentials and registers the
 * Featurebase tool provider with the shared registry when available.
 */
class FeaturebaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FeaturebaseService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FeaturebaseService(
                apiKey: $creds->get('featurebase', 'api_key', ''),
                baseUrl: $creds->get('featurebase', 'url', 'https://do.featurebase.app'),
                apiVersion: $creds->get('featurebase', 'api_version', '2026-01-01.nova'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new FeaturebaseToolProvider());
        }
    }
}
