<?php

namespace OpenCompany\Integrations\HeyGen;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the HeyGen integration.
 *
 * Registers the HeyGenService singleton with credentials resolved from the
 * integration core, and boots the tool provider into the ToolProviderRegistry
 * when available.
 */
class HeyGenServiceProvider extends ServiceProvider
{
    /**
     * Register the HeyGen service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(HeyGenService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new HeyGenService(
                apiKey: $creds->get('heygen', 'api_key', ''),
                baseUrl: $creds->get('heygen', 'url', 'https://api.heygen.com/v2'),
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
                ->register(new HeyGenToolProvider());
        }
    }
}
