<?php

namespace OpenCompany\Integrations\ConvertKit;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the ConvertKit integration with Laravel.
 *
 * Binds the current Kit API service using host credentials and registers the
 * ConvertKitToolProvider when the integration registry is available.
 */
class ConvertKitServiceProvider extends ServiceProvider
{
    /**
     * Register the ConvertKitService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ConvertKitService::class, function ($app): ConvertKitService {
            $creds = $app->make(CredentialResolver::class);

            return new ConvertKitService(
                apiKey: $creds->get('convertkit', 'api_key', ''),
                baseUrl: $creds->get('convertkit', 'url', 'https://api.kit.com'),
                accessToken: $creds->get('convertkit', 'oauth_access_token', ''),
            );
        });
    }

    /**
     * Register the ConvertKit tool provider with the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ConvertKitToolProvider());
        }
    }
}
