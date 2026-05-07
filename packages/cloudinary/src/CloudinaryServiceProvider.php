<?php

namespace OpenCompany\Integrations\Cloudinary;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Cloudinary integration with Laravel's service container.
 */
class CloudinaryServiceProvider extends ServiceProvider
{
    /**
     * Register the CloudinaryService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(CloudinaryService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CloudinaryService(
                accessToken: $creds->get('cloudinary', 'access_token', ''),
                cloudName: $creds->get('cloudinary', 'cloud_name', ''),
                baseUrl: $creds->get('cloudinary', 'base_url', 'https://api.cloudinary.com/v1_1'),
                apiKey: $creds->get('cloudinary', 'api_key', ''),
                apiSecret: $creds->get('cloudinary', 'api_secret', ''),
            );
        });
    }

    /**
     * Boot the service provider — register the tool provider with the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CloudinaryToolProvider());
        }
    }
}
