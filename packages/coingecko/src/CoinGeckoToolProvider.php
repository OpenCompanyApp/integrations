<?php

namespace OpenCompany\Integrations\CoinGecko;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoApiGet;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoCategoriesMarketData;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoCoinHistoryDate;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoCoinTickers;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoExchangeRates;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoExchangeVolumeChart;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoGetExchange;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoGetExchangeTickers;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoGlobal;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoGlobalDefi;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoHistory;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoInfo;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoListAssetPlatforms;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoListCategories;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoListCoins;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoListEntities;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoListExchangeIds;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoListExchanges;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoMarkets;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoNewCoins;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoOhlc;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoPrice;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoPublicTreasuryByCoin;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoPublicTreasuryEntity;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoSearchCoins;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoSimpleTokenPrice;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoTokenList;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoTopGainersLosers;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoTrending;

/**
 * Provides CoinGecko tools and setup metadata for host applications.
 */
class CoinGeckoToolProvider implements ConfigurableIntegration, HasIntegrationCapabilities, ToolProvider
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
            ],
        ];
    }

    public function appName(): string
    {
        return 'coingecko';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'CoinGecko',
            'description' => 'Cryptocurrency market data',
            'icon' => 'ph:coin',
            'logo' => 'ph:coin',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'CoinGecko',
            'description' => 'Cryptocurrency prices, markets, exchanges, categories, asset platforms, and treasury data',
            'icon' => 'ph:coin',
            'logo' => 'ph:coin',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.coingecko.com/reference/endpoint-overview',
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
                'hint' => 'Optional CoinGecko Demo API key from the CoinGecko Developer Dashboard. Public endpoints can also work without a key at lower rate limits.',
                'required' => false,
            ],
        ];
    }

    /**
     * Test CoinGecko connectivity with an optional Demo API key.
     *
     * @param  array<string, mixed>  $config  Integration configuration
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');

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
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'coingecko_search_coins' => $this->tool(CoinGeckoSearchCoins::class, 'CoinGecko Search Coins', 'Find cryptocurrencies by name or ticker symbol.'),
            'coingecko_list_coins' => $this->tool(CoinGeckoListCoins::class, 'CoinGecko List Coins', 'List supported CoinGecko coin IDs and optional asset-platform contract addresses.'),
            'coingecko_price' => $this->tool(CoinGeckoPrice::class, 'CoinGecko Price', 'Get current prices for one or more cryptocurrencies by CoinGecko ID.'),
            'coingecko_simple_token_price' => $this->tool(CoinGeckoSimpleTokenPrice::class, 'CoinGecko Token Price', 'Get token prices by asset platform and contract address.'),
            'coingecko_markets' => $this->tool(CoinGeckoMarkets::class, 'CoinGecko Markets', 'Get cryptocurrencies ranked by market cap with market data.'),
            'coingecko_top_gainers_losers' => $this->tool(CoinGeckoTopGainersLosers::class, 'CoinGecko Top Gainers Losers', 'Get top gainers and losers for a currency.'),
            'coingecko_new_coins' => $this->tool(CoinGeckoNewCoins::class, 'CoinGecko New Coins', 'List recently added CoinGecko coins.'),
            'coingecko_info' => $this->tool(CoinGeckoInfo::class, 'CoinGecko Info', 'Get a full coin profile with links and market data.'),
            'coingecko_coin_tickers' => $this->tool(CoinGeckoCoinTickers::class, 'CoinGecko Coin Tickers', 'Get tickers for a CoinGecko coin ID.'),
            'coingecko_coin_history_date' => $this->tool(CoinGeckoCoinHistoryDate::class, 'CoinGecko Coin History Date', 'Get historical coin data for a specific date.'),
            'coingecko_history' => $this->tool(CoinGeckoHistory::class, 'CoinGecko Market Chart', 'Get historical price, market cap, and volume chart data.'),
            'coingecko_ohlc' => $this->tool(CoinGeckoOhlc::class, 'CoinGecko OHLC', 'Get OHLC candlestick data for a coin.'),
            'coingecko_list_asset_platforms' => $this->tool(CoinGeckoListAssetPlatforms::class, 'CoinGecko Asset Platforms', 'List asset platform IDs and chain metadata.'),
            'coingecko_token_list' => $this->tool(CoinGeckoTokenList::class, 'CoinGecko Token List', 'Get token lists by asset platform ID.'),
            'coingecko_list_categories' => $this->tool(CoinGeckoListCategories::class, 'CoinGecko Categories', 'List CoinGecko category IDs.'),
            'coingecko_categories_market_data' => $this->tool(CoinGeckoCategoriesMarketData::class, 'CoinGecko Category Markets', 'List categories with market data.'),
            'coingecko_list_exchanges' => $this->tool(CoinGeckoListExchanges::class, 'CoinGecko Exchanges', 'List active exchanges with volume and trust data.'),
            'coingecko_list_exchange_ids' => $this->tool(CoinGeckoListExchangeIds::class, 'CoinGecko Exchange IDs', 'List exchange IDs and names.'),
            'coingecko_get_exchange' => $this->tool(CoinGeckoGetExchange::class, 'CoinGecko Exchange', 'Get exchange data by ID.'),
            'coingecko_get_exchange_tickers' => $this->tool(CoinGeckoGetExchangeTickers::class, 'CoinGecko Exchange Tickers', 'Get exchange tickers by exchange ID.'),
            'coingecko_exchange_volume_chart' => $this->tool(CoinGeckoExchangeVolumeChart::class, 'CoinGecko Exchange Volume Chart', 'Get historical exchange volume chart data.'),
            'coingecko_exchange_rates' => $this->tool(CoinGeckoExchangeRates::class, 'CoinGecko Exchange Rates', 'Get BTC exchange rates.'),
            'coingecko_trending' => $this->tool(CoinGeckoTrending::class, 'CoinGecko Trending', 'Get trending coins, NFTs, and categories.'),
            'coingecko_global' => $this->tool(CoinGeckoGlobal::class, 'CoinGecko Global', 'Get global cryptocurrency market statistics.'),
            'coingecko_global_defi' => $this->tool(CoinGeckoGlobalDefi::class, 'CoinGecko Global DeFi', 'Get global DeFi market statistics.'),
            'coingecko_list_entities' => $this->tool(CoinGeckoListEntities::class, 'CoinGecko Public Treasury Entities', 'List public treasury entities.'),
            'coingecko_public_treasury_by_coin' => $this->tool(CoinGeckoPublicTreasuryByCoin::class, 'CoinGecko Treasury By Coin', 'Get public treasury holdings by entity type and coin ID.'),
            'coingecko_public_treasury_entity' => $this->tool(CoinGeckoPublicTreasuryEntity::class, 'CoinGecko Treasury Entity', 'Get public treasury holdings by entity ID.'),
            'coingecko_api_get' => $this->tool(CoinGeckoApiGet::class, 'CoinGecko API GET', 'Call a read-only CoinGecko API v3 endpoint.'),
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return dirname(__DIR__).'/script-docs/coingecko.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => false, 'placeholder' => 'Optional CoinGecko Demo API key'],
        ];
    }

    /**
     * Create a CoinGecko tool with the correct account-scoped service.
     *
     * @param  array<string, mixed>  $context  Tool creation context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the CoinGecko service, including optional multi-account credentials.
     *
     * @param  array<string, mixed>  $context  Tool creation context
     */
    private function resolveService(array $context = []): CoinGeckoService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new CoinGeckoService(
                apiKey: $creds->get('coingecko', 'api_key', '', $account),
            );
        }

        return app(CoinGeckoService::class);
    }

    /**
     * Build standard tool metadata.
     *
     * @return array<string, mixed>
     */
    private function tool(string $class, string $name, string $description): array
    {
        return [
            'class' => $class,
            'type' => 'read',
            'name' => $name,
            'description' => $description,
            'icon' => 'ph:wrench',
        ];
    }
}
