<?php

namespace OpenCompany\Integrations\CoinGecko;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoGlobal;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoHistory;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoInfo;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoMarkets;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoOhlc;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoPrice;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoSearchCoins;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoTrending;

class CoinGeckoToolProvider implements ConfigurableIntegration, ToolProvider
{
    public function appName(): string
    {
        return 'coingecko';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'crypto, bitcoin, ethereum, prices, market data, coins, tokens',
            'description' => 'Cryptocurrency market data',
            'icon' => 'ph:coin',
            'logo' => 'ph:coin',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'CoinGecko',
            'description' => 'Cryptocurrency prices, market data, trending coins, and historical charts',
            'icon' => 'ph:coin',
            'logo' => 'ph:coin',
            'category' => 'finance',
            'badge' => 'verified',
            'docs_url' => 'https://docs.coingecko.com',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'Demo API Key',
                'placeholder' => 'CG-...',
                'hint' => 'Free key from <a href="https://www.coingecko.com/en/api/pricing" target="_blank">CoinGecko Developer Dashboard</a>. 30 calls/min, 10k calls/month.',
                'required' => false,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        try {
            $headers = $apiKey !== ''
                ? ['x-cg-demo-api-key' => $apiKey]
                : [];

            $response = Http::withHeaders($headers)->timeout(10)->get('https://api.coingecko.com/api/v3/simple/price', [
                'ids' => 'bitcoin',
                'vs_currencies' => 'usd',
            ]);

            if ($response->successful()) {
                $price = $response->json('bitcoin.usd');

                return [
                    'success' => true,
                    'message' => $price
                        ? ($apiKey !== '' ? "Connected to CoinGecko. BTC = \${$price}" : "Connected to CoinGecko without API key. BTC = \${$price}")
                        : ($apiKey !== '' ? 'Connected to CoinGecko.' : 'Connected to CoinGecko without API key.'),
                ];
            }

            $error = $response->json('status.error_message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'CoinGecko API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'coingecko_search_coins' => [
                'class' => CoinGeckoSearchCoins::class,
                'type' => 'read',
                'name' => 'Search Coins',
                'description' => 'Find cryptocurrencies by name or ticker symbol.',
                'icon' => 'ph:magnifying-glass',
            ],
            'coingecko_trending' => [
                'class' => CoinGeckoTrending::class,
                'type' => 'read',
                'name' => 'Trending Coins',
                'description' => 'Top trending cryptocurrencies in the last 24 hours.',
                'icon' => 'ph:fire',
            ],
            'coingecko_global' => [
                'class' => CoinGeckoGlobal::class,
                'type' => 'read',
                'name' => 'Global Market Overview',
                'description' => 'Overall crypto market statistics and BTC dominance.',
                'icon' => 'ph:globe',
            ],
            'coingecko_price' => [
                'class' => CoinGeckoPrice::class,
                'type' => 'read',
                'name' => 'Coin Price',
                'description' => 'Current price for one or more coins with 24h change and volume.',
                'icon' => 'ph:currency-circle-dollar',
            ],
            'coingecko_markets' => [
                'class' => CoinGeckoMarkets::class,
                'type' => 'read',
                'name' => 'Market Rankings',
                'description' => 'Top coins ranked by market cap with full market data.',
                'icon' => 'ph:chart-line-up',
            ],
            'coingecko_info' => [
                'class' => CoinGeckoInfo::class,
                'type' => 'read',
                'name' => 'Coin Info',
                'description' => 'Full coin profile with description, links, and market data.',
                'icon' => 'ph:info',
            ],
            'coingecko_history' => [
                'class' => CoinGeckoHistory::class,
                'type' => 'read',
                'name' => 'Price History',
                'description' => 'Historical price, volume, and market cap chart data.',
                'icon' => 'ph:clock-counter-clockwise',
            ],
            'coingecko_ohlc' => [
                'class' => CoinGeckoOhlc::class,
                'type' => 'read',
                'name' => 'OHLC Data',
                'description' => 'Candlestick data for technical analysis.',
                'icon' => 'ph:chart-bar',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/coingecko.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => false, 'placeholder' => 'Optional — increases rate limits'],
        ];
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new CoinGeckoService(
                apiKey: $creds->get('coingecko', 'api_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(CoinGeckoService::class));
    }
}
