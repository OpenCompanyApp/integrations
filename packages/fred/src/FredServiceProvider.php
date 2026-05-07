<?php

namespace OpenCompany\Integrations\Fred;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the FRED integration with Laravel's service container.
 *
 * Binds FredService using host credentials and registers the FredToolProvider
 * with the ToolProviderRegistry during boot.
 */
class FredServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FredService::class, function ($app): FredService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new FredService(apiKey: $creds?->get('fred', 'api_key', '') ?? '');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new FredToolProvider);
        }
    }
}
