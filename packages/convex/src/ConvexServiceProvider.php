<?php

namespace OpenCompany\Integrations\Convex;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Convex integration.
 *
 * Registers the ConvexService singleton and bootstraps the Convex tool provider.
 */
class ConvexServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ConvexService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ConvexService(
                accessToken: $creds->get('convex', 'access_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ConvexToolProvider());
        }
    }
}
