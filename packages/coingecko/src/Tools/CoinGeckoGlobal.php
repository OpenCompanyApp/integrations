<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

use OpenCompany\Integrations\CoinGecko\CoinGeckoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CoinGeckoGlobal implements Tool
{
    public function __construct(
        private CoinGeckoService $service,
    ) {}

    public function name(): string
    {
        return 'coingecko_global';
    }

    public function description(): string
    {
        return 'Get overall crypto market statistics — total market cap, BTC dominance, active cryptocurrencies, trading volume, and more.';
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
            $result = $this->service->getGlobal();
            $data = $result['data'] ?? [];

            return ToolResult::success([
                'active_cryptocurrencies' => $data['active_cryptocurrencies'] ?? null,
                'markets' => $data['markets'] ?? null,
                'total_market_cap_usd' => $data['total_market_cap']['usd'] ?? null,
                'total_volume_usd' => $data['total_volume']['usd'] ?? null,
                'market_cap_percentage' => $data['market_cap_percentage'] ?? [],
                'market_cap_change_percentage_24h_usd' => $data['market_cap_change_percentage_24h_usd'] ?? null,
                'updated_at' => $data['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
