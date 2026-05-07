<?php

namespace OpenCompany\Integrations\CoinGecko;

use Illuminate\Support\Facades\Http;

/**
 * HTTP client for CoinGecko API v3.
 *
 * Wraps public and demo-key endpoints for cryptocurrency market, exchange,
 * category, asset platform, exchange-rate, and public treasury data.
 */
class CoinGeckoService
{
    private const BASE_URL = 'https://api.coingecko.com/api/v3';

    /**
     * @param  string  $apiKey  Optional CoinGecko Demo API key
     * @param  string  $baseUrl  Base API URL for CoinGecko API v3
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = self::BASE_URL,
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
     * Get token prices by contract address on an asset platform.
     *
     * @param  array<int, string>  $contractAddresses  Token contract addresses
     * @param  array<int, string>  $currencies  Target currencies
     * @param  array<string, bool>  $opts  Optional includes for market cap, volume, 24h change, and update time
     * @return array<string, mixed>
     */
    public function getSimpleTokenPrice(string $assetPlatformId, array $contractAddresses, array $currencies, array $opts = []): array
    {
        $query = [
            'contract_addresses' => implode(',', $contractAddresses),
            'vs_currencies' => implode(',', $currencies),
        ];

        foreach (['include_market_cap', 'include_24hr_vol', 'include_24hr_change', 'include_last_updated_at'] as $opt) {
            if (! empty($opts[$opt])) {
                $query[$opt] = 'true';
            }
        }

        return $this->get('/simple/token_price/'.$this->segment($assetPlatformId), $query);
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
     * List supported CoinGecko coin IDs.
     *
     * @param  array<string, mixed>  $params  Optional include_platform and status filters
     * @return array<int, array<string, mixed>>
     */
    public function listCoins(array $params = []): array
    {
        return $this->get('/coins/list', $params);
    }

    /**
     * List recently added coins.
     *
     * @return array<string, mixed>
     */
    public function listNewCoins(): array
    {
        return $this->get('/coins/list/new');
    }

    /**
     * Get top gainers and losers by price change.
     *
     * @param  array<string, mixed>  $params  Optional duration, top_coins, and price_change_percentage filters
     * @return array<string, mixed>
     */
    public function getTopGainersLosers(string $vsCurrency, array $params = []): array
    {
        return $this->get('/coins/top_gainers_losers', array_merge(['vs_currency' => $vsCurrency], $params));
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

        return $this->get('/coins/'.$this->segment($id), array_merge($defaults, $params));
    }

    /**
     * Get centralized and decentralized exchange tickers for a coin.
     *
     * @param  array<string, mixed>  $params  Optional exchange_ids, include_exchange_logo, page, depth, order
     * @return array<string, mixed>
     */
    public function getCoinTickers(string $id, array $params = []): array
    {
        return $this->get('/coins/'.$this->segment($id).'/tickers', $params);
    }

    /**
     * Get historical coin metadata for a calendar date.
     *
     * @param  array<string, mixed>  $params  Optional localization flag
     * @return array<string, mixed>
     */
    public function getCoinHistory(string $id, string $date, array $params = []): array
    {
        return $this->get('/coins/'.$this->segment($id).'/history', array_merge(['date' => $date], $params));
    }

    /**
     * Get historical price, volume, and market cap chart data.
     *
     * @return array{prices: array, market_caps: array, total_volumes: array}
     */
    public function getMarketChart(string $id, string $vsCurrency, int $days): array
    {
        return $this->get('/coins/'.$this->segment($id).'/market_chart', [
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
        return $this->get('/coins/'.$this->segment($id).'/ohlc', [
            'vs_currency' => $vsCurrency,
            'days' => $days,
        ]);
    }

    /**
     * List CoinGecko asset platforms such as Ethereum, Polygon, and Solana.
     *
     * @param  array<string, mixed>  $params  Optional filter such as nft
     * @return array<int, array<string, mixed>>
     */
    public function listAssetPlatforms(array $params = []): array
    {
        return $this->get('/asset_platforms', $params);
    }

    /**
     * Get the token list for an asset platform.
     *
     * @return array<string, mixed>
     */
    public function getTokenList(string $assetPlatformId): array
    {
        return $this->get('/token_lists/'.$this->segment($assetPlatformId).'/all.json');
    }

    /**
     * List CoinGecko category IDs.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listCategories(): array
    {
        return $this->get('/coins/categories/list');
    }

    /**
     * List categories with market data.
     *
     * @param  array<string, mixed>  $params  Optional order
     * @return array<int, array<string, mixed>>
     */
    public function listCategoriesWithMarketData(array $params = []): array
    {
        return $this->get('/coins/categories', $params);
    }

    /**
     * List active exchanges with volume and trust-score data.
     *
     * @param  array<string, mixed>  $params  Optional per_page and page
     * @return array<int, array<string, mixed>>
     */
    public function listExchanges(array $params = []): array
    {
        return $this->get('/exchanges', $params);
    }

    /**
     * List exchange IDs and names.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listExchangeIds(): array
    {
        return $this->get('/exchanges/list');
    }

    /**
     * Get full exchange details by exchange ID.
     *
     * @return array<string, mixed>
     */
    public function getExchange(string $id): array
    {
        return $this->get('/exchanges/'.$this->segment($id));
    }

    /**
     * Get exchange tickers by exchange ID.
     *
     * @param  array<string, mixed>  $params  Optional coin_ids, include_exchange_logo, page, depth, order
     * @return array<string, mixed>
     */
    public function getExchangeTickers(string $id, array $params = []): array
    {
        return $this->get('/exchanges/'.$this->segment($id).'/tickers', $params);
    }

    /**
     * Get historical exchange volume chart data.
     *
     * @return array<int, array<int, int|float|string>>
     */
    public function getExchangeVolumeChart(string $id, int $days): array
    {
        return $this->get('/exchanges/'.$this->segment($id).'/volume_chart', ['days' => $days]);
    }

    /**
     * Get BTC exchange rates for fiat and crypto currencies.
     *
     * @return array<string, mixed>
     */
    public function getExchangeRates(): array
    {
        return $this->get('/exchange_rates');
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
     * Get global decentralized finance market stats.
     *
     * @return array<string, mixed>
     */
    public function getGlobalDefi(): array
    {
        return $this->get('/global/decentralized_finance_defi');
    }

    /**
     * List public treasury entities.
     *
     * @return array<string, mixed>
     */
    public function listEntities(): array
    {
        return $this->get('/entities/list');
    }

    /**
     * Get public-company or government crypto treasury holdings by coin ID.
     *
     * @param  array<string, mixed>  $params  Optional per_page, page, and order
     * @return array<string, mixed>
     */
    public function getPublicTreasuryByCoin(string $entity, string $coinId, array $params = []): array
    {
        if (! in_array($entity, ['companies', 'governments'], true)) {
            throw new \RuntimeException('entity must be companies or governments.');
        }

        return $this->get('/'.$entity.'/public_treasury/'.$this->segment($coinId), $params);
    }

    /**
     * Get public treasury holdings by entity ID.
     *
     * @param  array<string, mixed>  $params  Optional holding_amount_change and holding_change_percentage
     * @return array<string, mixed>
     */
    public function getPublicTreasuryEntity(string $entityId, array $params = []): array
    {
        return $this->get('/public_treasury/'.$this->segment($entityId), $params);
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
     * Call a CoinGecko GET endpoint that does not yet have a first-class tool.
     *
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>|array<int, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        $path = '/'.ltrim($path, '/');

        if (str_starts_with($path, '//') || str_contains($path, '://')) {
            throw new \RuntimeException('path must be a CoinGecko API path such as /derivatives.');
        }

        return $this->get($path, $params);
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
            ->get(rtrim($this->baseUrl, '/').$endpoint, array_filter($query, fn ($v) => $v !== '' && $v !== null));

        if ($response->status() === 429) {
            throw new \RuntimeException('CoinGecko rate limit exceeded. Try again in a moment.');
        }

        if (! $response->successful()) {
            $error = $response->json('error') ?? $response->json('status.error_message') ?? $response->body();
            throw new \RuntimeException('CoinGecko API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
        }

        return $response->json() ?? [];
    }

    /**
     * Encode a single URL path segment.
     */
    private function segment(string $value): string
    {
        return rawurlencode($value);
    }
}
