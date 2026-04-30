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

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class CoinGeckoToolProvider implements ConfigurableIntegration, ToolProvider, HasIntegrationCapabilities
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
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
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
            'description' => 'Cryptocurrency prices, market data, trending coins, and historical charts',
            'icon' => 'ph:coin',
            'logo' => 'ph:coin',
            'category' => 'finance',
            'badge' => 'verified',
            'docs_url' => 'https://docs.coingecko.com',
        ];
    }    public function configSchema(): array
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
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'coingecko_global' => [
                'class' => CoinGeckoGlobal::class,
                'type' => 'read',
                'name' => 'Coingecko Global',
                'description' => 'Get overall crypto market statistics — total market cap, BTC dominance, active cryptocurrencies, trading volume, and more.',
                'icon' => 'ph:wrench',
            ],
            'coingecko_history' => [
                'class' => CoinGeckoHistory::class,
                'type' => 'read',
                'name' => 'Coingecko History',
                'description' => 'Get historical price, volume, and market cap chart data for a cryptocurrency over a time period. Returns timestamped data points with summary statistics.',
                'icon' => 'ph:wrench',
            ],
            'coingecko_info' => [
                'class' => CoinGeckoInfo::class,
                'type' => 'read',
                'name' => 'Coingecko Info',
                'description' => 'Get a full coin profile — description, categories, links (website, whitepaper, social), and current market data snapshot. Use `coingecko_search_coins` first to find the coin ID.',
                'icon' => 'ph:wrench',
            ],
            'coingecko_markets' => [
                'class' => CoinGeckoMarkets::class,
                'type' => 'read',
                'name' => 'Coingecko Markets',
                'description' => 'Get top cryptocurrencies ranked by market cap with full market data (price, volume, ATH, supply, price changes). Supports filtering by category or specific coin IDs.',
                'icon' => 'ph:wrench',
            ],
            'coingecko_ohlc' => [
                'class' => CoinGeckoOhlc::class,
                'type' => 'read',
                'name' => 'Coingecko Ohlc',
                'description' => 'Get OHLC (Open/High/Low/Close) candlestick data for a cryptocurrency for technical analysis.',
                'icon' => 'ph:wrench',
            ],
            'coingecko_price' => [
                'class' => CoinGeckoPrice::class,
                'type' => 'read',
                'name' => 'Coingecko Price',
                'description' => 'Get current price for one or more cryptocurrencies (by CoinGecko ID). Includes 24h change, volume, and market cap. Use `coingecko_search_coins` first to find coin IDs.',
                'icon' => 'ph:wrench',
            ],
            'coingecko_search_coins' => [
                'class' => CoinGeckoSearchCoins::class,
                'type' => 'read',
                'name' => 'Coingecko Search Coins',
                'description' => 'Find cryptocurrencies by name or ticker symbol (e.g. "bitcoin", "ETH", "solana"). Returns matching coin IDs which are needed for other CoinGecko tools.',
                'icon' => 'ph:wrench',
            ],
            'coingecko_trending' => [
                'class' => CoinGeckoTrending::class,
                'type' => 'read',
                'name' => 'Coingecko Trending',
                'description' => 'Get the top trending cryptocurrencies in the last 24 hours based on search activity on CoinGecko.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/coingecko.md';
    }

    public function isIntegration(): bool
    {
        return true;
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
