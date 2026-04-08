<?php

namespace OpenCompany\Integrations\Kafka;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Kafka (Confluent Cloud) integration.
 *
 * Registers the KafkaService as a singleton and boots the ToolProvider
 * into the ToolProviderRegistry for auto-discovery.
 */
class KafkaServiceProvider extends ServiceProvider
{
    /**
     * Register the KafkaService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(KafkaService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new KafkaService(
                apiToken: $creds->get('kafka', 'api_token', ''),
                clusterId: $creds->get('kafka', 'cluster_id', ''),
            );
        });
    }

    /**
     * Boot the service provider and register the Kafka ToolProvider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new KafkaToolProvider());
        }
    }
}
