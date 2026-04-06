<?php

namespace OpenCompany\Integrations\Square;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class SquareServiceProvider extends ServiceProvider
{
    /**
     * Register the Square service as a singleton.
     */
    public function register(): void
    {
        $this->app->singleton(SquareService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SquareService(
                accessToken: $creds->get('square', 'access_token', ''),
                baseUrl: $creds->get('square', 'url', 'https://connect.squareup.com/v2'),
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
                ->register(new SquareToolProvider());
        }
    }
}
