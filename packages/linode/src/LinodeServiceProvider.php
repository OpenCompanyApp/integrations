<?php

namespace OpenCompany\Integrations\Linode;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Linode integration with Laravel.
 *
 * Binds the Linode API client from host credentials and registers the provider
 * with the shared tool registry when available.
 */
class LinodeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LinodeService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LinodeService(
                accessToken: $creds->get('linode', 'access_token', ''),
                baseUrl: $creds->get('linode', 'url', 'https://api.linode.com/v4'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new LinodeToolProvider());
        }
    }
}
