<?php

namespace OpenCompany\Integrations\DigitalOcean;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the DigitalOcean integration with Laravel.
 *
 * Binds the DigitalOcean API client from host credentials and registers the
 * tool provider with the shared discovery registry when available.
 */
class DigitalOceanServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DigitalOceanService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DigitalOceanService(
                accessToken: $creds->get('digitalocean', 'access_token', ''),
                baseUrl: $creds->get('digitalocean', 'url', 'https://api.digitalocean.com/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DigitalOceanToolProvider());
        }
    }
}
