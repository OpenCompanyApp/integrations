<?php

namespace OpenCompany\Integrations\Svix;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Svix integration with Laravel's service container.
 *
 * Binds SvixService using configured credentials and registers the Svix tool
 * provider with the shared ToolProviderRegistry when available.
 */
class SvixServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SvixService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SvixService(
                authToken: $creds->get('svix', 'auth_token', ''),
                baseUrl: $creds->get('svix', 'url', 'https://api.svix.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SvixToolProvider());
        }
    }
}
