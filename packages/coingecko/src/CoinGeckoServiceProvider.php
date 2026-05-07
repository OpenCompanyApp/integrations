<?php

namespace OpenCompany\Integrations\CoinGecko;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers CoinGecko services and tools with Laravel hosts.
 */
class CoinGeckoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CoinGeckoService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CoinGeckoService(
                apiKey: $creds->get('coingecko', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CoinGeckoToolProvider());
        }
    }
}
