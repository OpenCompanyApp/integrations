<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

use OpenCompany\Integrations\CoinGecko\CoinGeckoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get OHLC candlestick data for a CoinGecko coin.
 */
class CoinGeckoOhlc implements Tool
{
    /**
     * @param  CoinGeckoService  $service  CoinGecko API client
     */
    public function __construct(
        private CoinGeckoService $service,
    ) {}

    public function name(): string
    {
        return 'coingecko_ohlc';
    }

    public function description(): string
    {
        return 'Get OHLC (Open/High/Low/Close) candlestick data for a cryptocurrency for technical analysis.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'CoinGecko coin ID (e.g. "bitcoin", "ethereum", "solana"). Use coingecko_search_coins to find IDs.'],
            'currency' => ['type' => 'string', 'description' => 'Target currency (default: "usd").'],
            'days' => ['type' => 'string', 'description' => 'Number of days of OHLC data (default: "30"). Common values: 1, 7, 14, 30, 90, 365.'],
        ];
    }

    /**
     * Execute the OHLC lookup.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('CoinGecko is not configured. Please set up the API key in Integrations.');
        }

        try {
            $id = $args['id'] ?? null;
            if (! $id) {
                return ToolResult::error('id is required. Use coingecko_search_coins to find coin IDs.');
            }

            $currency = $args['currency'] ?? 'usd';
            $days = (int) ($args['days'] ?? 30);

            $result = $this->service->getOhlc($id, $currency, $days);

            // Limit to 50 candles
            $maxCandles = 50;
            if (count($result) > $maxCandles) {
                $step = (int) ceil(count($result) / $maxCandles);
                $result = array_values(array_filter($result, fn ($_, int $i) => $i % $step === 0, ARRAY_FILTER_USE_BOTH));
            }

            $candles = array_map(fn (array $c) => [
                'date' => date('Y-m-d H:i', (int) ($c[0] / 1000)),
                'open' => $c[1],
                'high' => $c[2],
                'low' => $c[3],
                'close' => $c[4],
            ], $result);

            return ToolResult::success([
                'coin_id' => $id,
                'currency' => $currency,
                'days' => $days,
                'candles' => $candles,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
