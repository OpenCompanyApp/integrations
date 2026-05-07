<?php

namespace OpenCompany\Integrations\UsCensus;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the US Census integration with Laravel's service container.
 *
 * Binds UsCensusService with an optional API key and registers the provider
 * with the ToolProviderRegistry during boot.
 */
class UsCensusServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(UsCensusService::class, function ($app): UsCensusService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new UsCensusService(apiKey: $creds?->get('us-census', 'api_key', '') ?? '');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new UsCensusToolProvider);
        }
    }
}
