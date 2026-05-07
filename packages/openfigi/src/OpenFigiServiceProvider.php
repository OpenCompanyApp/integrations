<?php

namespace OpenCompany\Integrations\OpenFigi;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the OpenFIGI integration with Laravel's service container.
 *
 * Binds OpenFigiService using optional host credentials and registers the
 * OpenFigiToolProvider with the ToolProviderRegistry during boot.
 */
class OpenFigiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(OpenFigiService::class, function ($app): OpenFigiService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new OpenFigiService(apiKey: $creds?->get('openfigi', 'api_key', '') ?? '');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new OpenFigiToolProvider);
        }
    }
}
