<?php

namespace OpenCompany\Integrations\Dub;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Dub integration with Laravel's service container.
 *
 * Binds DubService using the host credential resolver and registers the Dub
 * tool provider with the shared provider registry.
 */
class DubServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DubService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DubService(
                accessToken: $creds->get('dub', 'access_token', ''),
                baseUrl: $creds->get('dub', 'base_url', 'https://api.dub.co'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DubToolProvider());
        }
    }
}
