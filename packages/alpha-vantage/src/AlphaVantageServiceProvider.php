<?php

namespace OpenCompany\Integrations\AlphaVantage;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Alpha Vantage integration with Laravel's service container.
 *
 * Binds AlphaVantageService using host credentials and registers the provider
 * with the shared ToolProviderRegistry during boot.
 */
class AlphaVantageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AlphaVantageService::class, function ($app): AlphaVantageService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new AlphaVantageService(apiKey: $creds?->get('alpha-vantage', 'api_key', '') ?? '');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new AlphaVantageToolProvider);
        }
    }
}
