<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

use OpenCompany\Integrations\CoinGecko\CoinGeckoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get ranked market data for CoinGecko coins.
 */
class CoinGeckoMarkets implements Tool
{
    /**
     * @param  CoinGeckoService  $service  CoinGecko API client
     */
    public function __construct(
        private CoinGeckoService $service,
    ) {}

    public function name(): string
    {
        return 'coingecko_markets';
    }

    public function description(): string
    {
        return 'Get top cryptocurrencies ranked by market cap with full market data (price, volume, ATH, supply, price changes). Supports filtering by category or specific coin IDs.';
    }

    public function parameters(): array
    {
        return [
            'ids' => ['type' => 'string', 'description' => 'Comma-separated CoinGecko coin IDs to filter to specific coins (e.g. "bitcoin,ethereum,solana").'],
            'currency' => ['type' => 'string', 'description' => 'Target currency (default: "usd"). Common: usd, eur, gbp, btc.'],
            'category' => ['type' => 'string', 'description' => 'Filter by category (e.g. "decentralized-finance-defi", "layer-1"). Use coingecko_search_coins to find category IDs.'],
            'per_page' => ['type' => 'string', 'description' => 'Number of results per page (default: "20", max: 100).'],
            'page' => ['type' => 'string', 'description' => 'Page number for pagination (default: "1").'],
            'price_change_percentage' => ['type' => 'string', 'description' => 'Comma-separated price change timeframes (default: "24h,7d"). Options: 1h, 24h, 7d, 14d, 30d, 200d, 1y.'],
        ];
    }

    /**
     * Execute the markets lookup.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('CoinGecko is not configured. Please set up the API key in Integrations.');
        }

        try {
            $currency = $args['currency'] ?? 'usd';
            $perPage = min((int) ($args['per_page'] ?? 20), 100);
            $page = max((int) ($args['page'] ?? 1), 1);

            $params = [
                'order' => 'market_cap_desc',
                'per_page' => $perPage,
                'page' => $page,
                'sparkline' => 'false',
                'price_change_percentage' => $args['price_change_percentage'] ?? '24h,7d',
            ];

            if ($args['ids'] ?? null) {
                $params['ids'] = $args['ids'];
            }

            if ($args['category'] ?? null) {
                $params['category'] = $args['category'];
            }

            $result = $this->service->getMarkets($currency, $params);

            // Slim each coin to the most useful fields
            $coins = array_map(fn (array $coin) => [
                'id' => $coin['id'] ?? null,
                'symbol' => $coin['symbol'] ?? null,
                'name' => $coin['name'] ?? null,
                'current_price' => $coin['current_price'] ?? null,
                'market_cap' => $coin['market_cap'] ?? null,
                'market_cap_rank' => $coin['market_cap_rank'] ?? null,
                'total_volume' => $coin['total_volume'] ?? null,
                'high_24h' => $coin['high_24h'] ?? null,
                'low_24h' => $coin['low_24h'] ?? null,
                'price_change_percentage_24h' => $coin['price_change_percentage_24h'] ?? null,
                'price_change_percentage_7d_in_currency' => $coin['price_change_percentage_7d_in_currency'] ?? null,
                'circulating_supply' => $coin['circulating_supply'] ?? null,
                'total_supply' => $coin['total_supply'] ?? null,
                'max_supply' => $coin['max_supply'] ?? null,
                'ath' => $coin['ath'] ?? null,
                'ath_change_percentage' => $coin['ath_change_percentage'] ?? null,
            ], $result);

            return ToolResult::success(['coins' => $coins, 'currency' => $currency, 'page' => $page]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
