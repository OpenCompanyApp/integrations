<?php

namespace OpenCompany\Integrations\Upstash;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Upstash integration.
 *
 * Registers the UpstashService as a singleton (credentials resolved at
 * resolution time) and boots the tool provider into the registry.
 */
class UpstashServiceProvider extends ServiceProvider
{
    /**
     * Register the UpstashService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(UpstashService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new UpstashService(
                apiKey: $creds->get('upstash', 'api_key', ''),
                redisUrl: $creds->get('upstash', 'redis_url', ''),
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
                ->register(new UpstashToolProvider());
        }
    }
}
