<?php

namespace OpenCompany\Integrations\Hetzner;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Hetzner Cloud integration with Laravel's service container.
 *
 * Binds the shared API service and registers the generated tool provider.
 */
class HetznerServiceProvider extends ServiceProvider
{
    /**
     * Register the Hetzner Cloud service singleton.
     */
    public function register(): void
    {
        $this->app->singleton(HetznerService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new HetznerService(
                accessToken: $creds->get('hetzner', 'access_token', ''),
                baseUrl: $creds->get('hetzner', 'url', 'https://api.hetzner.cloud/v1'),
            );
        });
    }

    /**
     * Register the tool provider when the host registry is available.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new HetznerToolProvider());
        }
    }
}
