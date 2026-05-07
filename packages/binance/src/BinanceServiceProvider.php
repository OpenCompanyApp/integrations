<?php

namespace OpenCompany\Integrations\Binance;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Binance integration with Laravel's service container.
 *
 * Binds BinanceService from host credentials and registers the tool provider
 * with the discovery registry when available.
 */
class BinanceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BinanceService::class, function ($app): BinanceService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new BinanceService(
                apiKey: $creds?->get('binance', 'api_key', '') ?? '',
                apiSecret: $creds?->get('binance', 'api_secret', '') ?? '',
                baseUrl: $creds?->get('binance', 'url', 'https://api.binance.com') ?? 'https://api.binance.com',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new BinanceToolProvider);
        }
    }
}
