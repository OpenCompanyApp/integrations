<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

use OpenCompany\Integrations\CoinGecko\CoinGeckoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a normalized profile for a CoinGecko coin.
 */
class CoinGeckoInfo implements Tool
{
    /**
     * @param  CoinGeckoService  $service  CoinGecko API client
     */
    public function __construct(
        private CoinGeckoService $service,
    ) {}

    public function name(): string
    {
        return 'coingecko_info';
    }

    public function description(): string
    {
        return 'Get a full coin profile — description, categories, links (website, whitepaper, social), and current market data snapshot. Use `coingecko_search_coins` first to find the coin ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'CoinGecko coin ID (e.g. "bitcoin", "ethereum", "solana"). Use coingecko_search_coins to find IDs.'],
        ];
    }

    /**
     * Execute the coin profile lookup.
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

            $coin = $this->service->getCoin($id, [
                'market_data' => 'true',
            ]);

            $marketData = $coin['market_data'] ?? [];

            $description = $coin['description']['en'] ?? null;

            // Trim null description to save tokens
            if ($description && strlen($description) > 1000) {
                $description = substr($description, 0, 1000) . '...';
            }

            return ToolResult::success([
                'id' => $coin['id'] ?? null,
                'symbol' => $coin['symbol'] ?? null,
                'name' => $coin['name'] ?? null,
                'description' => $description,
                'categories' => $coin['categories'] ?? [],
                'links' => [
                    'homepage' => $coin['links']['homepage'][0] ?? null,
                    'whitepaper' => $coin['links']['whitepaper'] ?? null,
                    'twitter' => $coin['links']['twitter_screen_name'] ?? null,
                    'subreddit' => $coin['links']['subreddit_url'] ?? null,
                    'github' => $coin['links']['repos_url']['github'][0] ?? null,
                ],
                'market_data' => [
                    'current_price_usd' => $marketData['current_price']['usd'] ?? null,
                    'market_cap_usd' => $marketData['market_cap']['usd'] ?? null,
                    'market_cap_rank' => $marketData['market_cap_rank'] ?? null,
                    'total_volume_usd' => $marketData['total_volume']['usd'] ?? null,
                    'high_24h_usd' => $marketData['high_24h']['usd'] ?? null,
                    'low_24h_usd' => $marketData['low_24h']['usd'] ?? null,
                    'price_change_percentage_24h' => $marketData['price_change_percentage_24h'] ?? null,
                    'price_change_percentage_7d' => $marketData['price_change_percentage_7d'] ?? null,
                    'price_change_percentage_30d' => $marketData['price_change_percentage_30d'] ?? null,
                    'ath_usd' => $marketData['ath']['usd'] ?? null,
                    'ath_change_percentage' => $marketData['ath_change_percentage']['usd'] ?? null,
                    'ath_date' => $marketData['ath_date']['usd'] ?? null,
                    'atl_usd' => $marketData['atl']['usd'] ?? null,
                    'circulating_supply' => $marketData['circulating_supply'] ?? null,
                    'total_supply' => $marketData['total_supply'] ?? null,
                    'max_supply' => $marketData['max_supply'] ?? null,
                ],
                'genesis_date' => $coin['genesis_date'] ?? null,
                'sentiment_votes_up_percentage' => $coin['sentiment_votes_up_percentage'] ?? null,
                'sentiment_votes_down_percentage' => $coin['sentiment_votes_down_percentage'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
