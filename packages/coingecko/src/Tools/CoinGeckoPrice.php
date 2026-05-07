<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

use OpenCompany\Integrations\CoinGecko\CoinGeckoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get current prices for CoinGecko coin IDs.
 */
class CoinGeckoPrice implements Tool
{
    /**
     * @param  CoinGeckoService  $service  CoinGecko API client
     */
    public function __construct(
        private CoinGeckoService $service,
    ) {}

    public function name(): string
    {
        return 'coingecko_price';
    }

    public function description(): string
    {
        return 'Get current price for one or more cryptocurrencies (by CoinGecko ID). Includes 24h change, volume, and market cap. Use `coingecko_search_coins` first to find coin IDs.';
    }

    public function parameters(): array
    {
        return [
            'ids' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated CoinGecko coin IDs (e.g. "bitcoin,ethereum,solana"). Use coingecko_search_coins to find IDs.'],
            'currencies' => ['type' => 'string', 'description' => 'Comma-separated target currencies (default: "usd"). E.g. "usd,eur,btc".'],
        ];
    }

    /**
     * Execute the price lookup.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('CoinGecko is not configured. Please set up the API key in Integrations.');
        }

        try {
            $ids = $args['ids'] ?? null;
            if (! $ids) {
                return ToolResult::error('ids is required. Use comma-separated CoinGecko IDs (e.g. "bitcoin,ethereum"). Use coingecko_search_coins to find IDs.');
            }

            $currencies = $args['currencies'] ?? 'usd';

            $result = $this->service->getPrice(
                ids: array_map('trim', explode(',', $ids)),
                currencies: array_map('trim', explode(',', $currencies)),
                opts: [
                    'include_market_cap' => true,
                    'include_24hr_vol' => true,
                    'include_24hr_change' => true,
                    'include_last_updated_at' => true,
                ],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
