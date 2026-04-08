<?php

namespace OpenCompany\Integrations\SparkPost;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the SparkPost integration.
 *
 * Registers the SparkPostService singleton and boots the tool provider
 * into the ToolProviderRegistry.
 */
class SparkPostServiceProvider extends ServiceProvider
{
    /**
     * Register the SparkPostService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(SparkPostService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SparkPostService(
                apiKey: $creds->get('spark-post', 'api_key', ''),
                baseUrl: $creds->get('spark-post', 'url', 'https://api.sparkpost.com/api/v1'),
            );
        });
    }

    /**
     * Boot the SparkPost tool provider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SparkPostToolProvider());
        }
    }
}
