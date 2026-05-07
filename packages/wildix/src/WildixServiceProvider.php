<?php

namespace OpenCompany\Integrations\Wildix;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Wildix integration with Laravel's service container.
 *
 * Binds WildixService using host credentials and registers WildixToolProvider
 * with the shared ToolProviderRegistry when available.
 */
class WildixServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(WildixService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WildixService(
                accessToken: $creds->get('wildix', 'access_token', ''),
                baseUrl: $creds->get('wildix', 'url', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new WildixToolProvider());
        }
    }
}
