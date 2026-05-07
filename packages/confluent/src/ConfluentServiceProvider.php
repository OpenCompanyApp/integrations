<?php

namespace OpenCompany\Integrations\Confluent;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Confluent Cloud integration.
 *
 * Registers the ConfluentService as a singleton and boots the ToolProvider
 * into the ToolProviderRegistry for auto-discovery.
 */
class ConfluentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ConfluentService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ConfluentService(
                apiKey: (string) $creds->get('confluent', 'api_key', ''),
                apiSecret: (string) $creds->get('confluent', 'api_secret', ''),
                accessToken: (string) $creds->get('confluent', 'access_token', ''),
                apiToken: (string) $creds->get('confluent', 'api_token', ''),
                clusterId: (string) $creds->get('confluent', 'cluster_id', ''),
                baseUrl: (string) $creds->get('confluent', 'url', 'https://api.confluent.cloud'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ConfluentToolProvider);
        }
    }
}
