<?php

namespace OpenCompany\Integrations\Gong;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Gong integration.
 *
 * Registers the GongService singleton and bootstraps the tool provider
 * with the ToolProviderRegistry when available.
 */
class GongServiceProvider extends ServiceProvider
{
    /**
     * Register the GongService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(GongService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GongService(
                accessKey: $creds->get('gong', 'access_key', ''),
                accessKeySecret: $creds->get('gong', 'access_key_secret', ''),
                baseUrl: $creds->get('gong', 'url', 'https://api.gong.io'),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GongToolProvider());
        }
    }
}
