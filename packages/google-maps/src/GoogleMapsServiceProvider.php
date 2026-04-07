<?php

namespace OpenCompany\Integrations\GoogleMaps;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class GoogleMapsServiceProvider extends ServiceProvider
{
    /**
     * Register the Google Maps service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(GoogleMapsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GoogleMapsService(
                apiKey: $creds->get('google-maps', 'api_key', ''),
                baseUrl: $creds->get('google-maps', 'url', 'https://maps.googleapis.com/maps/api'),
            );
        });
    }

    /**
     * Boot the Google Maps integration by registering the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GoogleMapsToolProvider());
        }
    }
}
