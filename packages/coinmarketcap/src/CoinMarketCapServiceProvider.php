<?php

namespace OpenCompany\Integrations\CoinMarketCap;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the CoinMarketCap integration with Laravel's service container.
 *
 * Binds CoinMarketCapService from host credentials and registers the tool
 * provider with the discovery registry when available.
 */
class CoinMarketCapServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CoinMarketCapService::class, function ($app): CoinMarketCapService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new CoinMarketCapService(
                apiKey: $creds?->get('coinmarketcap', 'api_key', '') ?? '',
                baseUrl: $creds?->get('coinmarketcap', 'url', 'https://pro-api.coinmarketcap.com') ?? 'https://pro-api.coinmarketcap.com',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new CoinMarketCapToolProvider);
        }
    }
}
