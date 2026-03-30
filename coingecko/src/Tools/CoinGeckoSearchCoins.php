<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

use OpenCompany\Integrations\CoinGecko\CoinGeckoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CoinGeckoSearchCoins implements Tool
{
    public function __construct(
        private CoinGeckoService $service,
    ) {}

    public function name(): string
    {
        return 'coingecko_search_coins';
    }

    public function description(): string
    {
        return 'Find cryptocurrencies by name or ticker symbol (e.g. "bitcoin", "ETH", "solana"). Returns matching coin IDs which are needed for other CoinGecko tools.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Search query — coin name or ticker symbol (e.g. "bitcoin", "ETH").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('CoinGecko is not configured. Please set up the API key in Integrations.');
        }

        try {
            $query = $args['query'] ?? null;
            if (! $query) {
                return ToolResult::error('query is required for the search action.');
            }

            $result = $this->service->search($query);

            // Slim down to the most useful fields
            $coins = array_map(fn (array $coin) => [
                'id' => $coin['id'] ?? null,
                'name' => $coin['name'] ?? null,
                'symbol' => $coin['symbol'] ?? null,
                'market_cap_rank' => $coin['market_cap_rank'] ?? null,
            ], $result['coins'] ?? []);

            $categories = array_map(fn (array $cat) => [
                'id' => $cat['id'] ?? null,
                'name' => $cat['name'] ?? null,
            ], $result['categories'] ?? []);

            return ToolResult::success([
                'coins' => array_slice($coins, 0, 20),
                'categories' => array_slice($categories, 0, 10),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
