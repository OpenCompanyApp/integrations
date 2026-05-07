<?php

namespace OpenCompany\Integrations\FlyIo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Fly.io integration with Laravel.
 *
 * Binds the Fly.io Machines API client from host credentials and registers the
 * provider with the shared discovery registry when available.
 */
class FlyIoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FlyIoService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FlyIoService(
                accessToken: $creds->get('fly-io', 'access_token', ''),
                baseUrl: $creds->get('fly-io', 'url', 'https://api.machines.dev/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FlyIoToolProvider());
        }
    }
}
