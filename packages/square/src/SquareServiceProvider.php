<?php

namespace OpenCompany\Integrations\Square;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Square integration package.
 */
class SquareServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SquareService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SquareService(
                accessToken: $creds->get('square', 'access_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SquareToolProvider());
        }
    }
}
