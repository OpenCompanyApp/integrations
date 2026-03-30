<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

use OpenCompany\Integrations\CoinGecko\CoinGeckoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CoinGeckoTrending implements Tool
{
    public function __construct(
        private CoinGeckoService $service,
    ) {}

    public function name(): string
    {
        return 'coingecko_trending';
    }

    public function description(): string
    {
        return 'Get the top trending cryptocurrencies in the last 24 hours based on search activity on CoinGecko.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('CoinGecko is not configured. Please set up the API key in Integrations.');
        }

        try {
            $result = $this->service->getTrending();

            $coins = array_map(function (array $item) {
                $coin = $item['item'] ?? $item;

                return [
                    'id' => $coin['id'] ?? null,
                    'name' => $coin['name'] ?? null,
                    'symbol' => $coin['symbol'] ?? null,
                    'market_cap_rank' => $coin['market_cap_rank'] ?? null,
                    'price_btc' => $coin['price_btc'] ?? null,
                    'price_usd' => $coin['data']['price'] ?? null,
                    'price_change_24h' => $coin['data']['price_change_percentage_24h']['usd'] ?? null,
                    'market_cap' => $coin['data']['market_cap'] ?? null,
                ];
            }, $result['coins'] ?? []);

            return ToolResult::success(['trending_coins' => $coins]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
