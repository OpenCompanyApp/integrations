<?php

namespace OpenCompany\Integrations\CoinGecko;

use Illuminate\Support\Facades\Http;

class CoinGeckoService
{
    private const BASE_URL = 'https://api.coingecko.com/api/v3';

    public function __construct(
        private string $apiKey = '',
    ) {}

    public function isConfigured(): bool
    {
        return true;
    }

    /** Check API connectivity. */
    public function ping(): bool
    {
        $response = $this->get('/ping');

        return isset($response['gecko_says']);
    }

    /**
     * Search for coins, exchanges, and categories by query.
     *
     * @return array{coins: array, exchanges: array, categories: array}
     */
    public function search(string $query): array
    {
        return $this->get('/search', ['query' => $query]);
    }

    /**
     * Get current price for one or more coins.
     *
     * @param  array<int, string>  $ids  CoinGecko coin IDs
     * @param  array<int, string>  $currencies  Target currencies (e.g. ['usd', 'eur'])
     * @param  array<string, bool>  $opts  Optional includes: include_market_cap, include_24hr_vol, include_24hr_change, include_last_updated_at
     */
    public function getPrice(array $ids, array $currencies, array $opts = []): array
    {
        $query = [
            'ids' => implode(',', $ids),
            'vs_currencies' => implode(',', $currencies),
        ];

        foreach (['include_market_cap', 'include_24hr_vol', 'include_24hr_change', 'include_last_updated_at'] as $opt) {
            if (! empty($opts[$opt])) {
                $query[$opt] = 'true';
            }
        }

        return $this->get('/simple/price', $query);
    }

    /**
     * Get coins ranked by market cap with rich market data.
     *
     * @param  array<string, mixed>  $params  Optional: ids, category, order, per_page, page, sparkline, price_change_percentage
     */
    public function getMarkets(string $vsCurrency, array $params = []): array
    {
        return $this->get('/coins/markets', array_merge(['vs_currency' => $vsCurrency], $params));
    }

    /**
     * Get full coin details: description, links, categories, market data.
     *
     * @param  array<string, mixed>  $params  Optional: localization, tickers, market_data, community_data, developer_data, sparkline
     */
    public function getCoin(string $id, array $params = []): array
    {
        $defaults = [
            'localization' => 'false',
            'tickers' => 'false',
            'community_data' => 'false',
            'developer_data' => 'false',
        ];

        return $this->get("/coins/{$id}", array_merge($defaults, $params));
    }

    /**
     * Get historical price, volume, and market cap chart data.
     *
     * @return array{prices: array, market_caps: array, total_volumes: array}
     */
    public function getMarketChart(string $id, string $vsCurrency, int $days): array
    {
        return $this->get("/coins/{$id}/market_chart", [
            'vs_currency' => $vsCurrency,
            'days' => $days,
            'interval' => $days > 90 ? 'daily' : '',
        ]);
    }

    /**
     * Get OHLC candlestick data.
     *
     * @return array<int, array{0: int, 1: float, 2: float, 3: float, 4: float}>
     */
    public function getOhlc(string $id, string $vsCurrency, int $days): array
    {
        return $this->get("/coins/{$id}/ohlc", [
            'vs_currency' => $vsCurrency,
            'days' => $days,
        ]);
    }

    /**
     * Get trending coins, NFTs, and categories.
     *
     * @return array{coins: array, nfts: array, categories: array}
     */
    public function getTrending(): array
    {
        return $this->get('/search/trending');
    }

    /**
     * Get global crypto market stats.
     *
     * @return array{data: array}
     */
    public function getGlobal(): array
    {
        return $this->get('/global');
    }

    /**
     * Get the list of supported target currencies.
     *
     * @return array<int, string>
     */
    public function getSupportedCurrencies(): array
    {
        return $this->get('/simple/supported_vs_currencies');
    }

    /**
     * Make a GET request to the CoinGecko API.
     *
     * @param  array<string, mixed>  $query
     * @return array<string, mixed>
     *
     * @throws \RuntimeException
     */
    private function get(string $endpoint, array $query = []): array
    {
        $headers = [];

        if ($this->apiKey !== '') {
            $headers['x-cg-demo-api-key'] = $this->apiKey;
        }

        $response = Http::withHeaders($headers)
            ->timeout(15)
            ->get(self::BASE_URL.$endpoint, array_filter($query, fn ($v) => $v !== '' && $v !== null));

        if ($response->status() === 429) {
            throw new \RuntimeException('CoinGecko rate limit exceeded. Try again in a moment.');
        }

        if (! $response->successful()) {
            $error = $response->json('error') ?? $response->json('status.error_message') ?? $response->body();
            throw new \RuntimeException('CoinGecko API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
        }

        return $response->json() ?? [];
    }
}
