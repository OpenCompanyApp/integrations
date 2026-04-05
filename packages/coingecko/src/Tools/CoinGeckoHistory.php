<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

use OpenCompany\Integrations\CoinGecko\CoinGeckoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CoinGeckoHistory implements Tool
{
    public function __construct(
        private CoinGeckoService $service,
    ) {}

    public function name(): string
    {
        return 'coingecko_history';
    }

    public function description(): string
    {
        return 'Get historical price, volume, and market cap chart data for a cryptocurrency over a time period. Returns timestamped data points with summary statistics.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'CoinGecko coin ID (e.g. "bitcoin", "ethereum", "solana"). Use coingecko_search_coins to find IDs.'],
            'currency' => ['type' => 'string', 'description' => 'Target currency (default: "usd").'],
            'days' => ['type' => 'string', 'description' => 'Number of days of history (default: "30"). Common values: 1, 7, 14, 30, 90, 365.'],
        ];
    }

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

            $result = $this->service->getMarketChart($id, $currency, $days);

            $prices = $result['prices'] ?? [];
            $volumes = $result['total_volumes'] ?? [];

            // Compute summary stats
            $priceValues = array_column($prices, 1);
            $summary = [
                'coin_id' => $id,
                'currency' => $currency,
                'days' => $days,
                'data_points' => count($prices),
            ];

            if (! empty($priceValues)) {
                $summary['start_price'] = $priceValues[0];
                $summary['end_price'] = end($priceValues);
                $summary['high'] = max($priceValues);
                $summary['low'] = min($priceValues);
                $summary['change_percentage'] = $priceValues[0] > 0
                    ? round(((end($priceValues) - $priceValues[0]) / $priceValues[0]) * 100, 2)
                    : null;
            }

            // Limit data points to avoid massive responses
            $maxPoints = 50;
            if (count($prices) > $maxPoints) {
                $step = (int) ceil(count($prices) / $maxPoints);
                $prices = array_values(array_filter($prices, fn ($_, int $i) => $i % $step === 0, ARRAY_FILTER_USE_BOTH));
                $volumes = array_values(array_filter($volumes, fn ($_, int $i) => $i % $step === 0, ARRAY_FILTER_USE_BOTH));
                $summary['sampled'] = true;
                $summary['sample_interval'] = $step;
            }

            // Format timestamps to ISO dates
            $formattedPrices = array_map(fn (array $p) => [
                'date' => date('Y-m-d H:i', (int) ($p[0] / 1000)),
                'price' => $p[1],
            ], $prices);

            $formattedVolumes = array_map(fn (array $v) => [
                'date' => date('Y-m-d H:i', (int) ($v[0] / 1000)),
                'volume' => $v[1],
            ], $volumes);

            return ToolResult::success([
                'summary' => $summary,
                'prices' => $formattedPrices,
                'volumes' => $formattedVolumes,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
