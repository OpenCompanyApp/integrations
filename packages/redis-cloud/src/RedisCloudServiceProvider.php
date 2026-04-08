<?php

namespace OpenCompany\Integrations\RedisCloud;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Redis Cloud integration.
 *
 * Registers the RedisCloudService as a singleton (credentials resolved at
 * resolution time) and boots the tool provider into the registry.
 */
class RedisCloudServiceProvider extends ServiceProvider
{
    /**
     * Register the RedisCloudService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(RedisCloudService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new RedisCloudService(
                apiKey: $creds->get('redis-cloud', 'api_key', ''),
                secretKey: $creds->get('redis-cloud', 'secret_key', ''),
            );
        });
    }

    /**
     * Boot the tool provider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new RedisCloudToolProvider());
        }
    }
}
