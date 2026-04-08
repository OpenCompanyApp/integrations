<?php

namespace OpenCompany\Integrations\Confluent;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Confluent Cloud Kafka integration.
 *
 * Registers the ConfluentService as a singleton and boots the ToolProvider
 * into the ToolProviderRegistry for auto-discovery.
 */
class ConfluentServiceProvider extends ServiceProvider
{
    /**
     * Register the ConfluentService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ConfluentService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ConfluentService(
                apiToken: $creds->get('confluent', 'api_token', ''),
                clusterId: $creds->get('confluent', 'cluster_id', ''),
            );
        });
    }

    /**
     * Boot the service provider and register the Confluent ToolProvider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ConfluentToolProvider());
        }
    }
}
