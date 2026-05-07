<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Cryptocurrency Market Pairs Latest.
 *
 * Maps to the official CoinMarketCap endpoint GET /v2/cryptocurrency/market-pairs/latest.
 */
class CoinMarketCapGetV2CryptocurrencyMarketPairsLatest extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v2_cryptocurrency_market_pairs_latest';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v2/cryptocurrency/market-pairs/latest.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A cryptocurrency or fiat currency by CoinMarketCap ID to list market pairs for. Example: "1"',
        ],
        'slug' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively pass a cryptocurrency by slug. Example: "bitcoin"',
        ],
        'symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively pass a cryptocurrency by symbol. Fiat currencies are not supported by this field. Example: "BTC". A single cryptocurrency "id", "slug", *or* "symbol" is required.',
        ],
        'start' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
        ],
        'sort_dir' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify the sort direction of markets returned.',
            'enum' => [
                'asc',
                'desc',
            ],
        ],
        'sort' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify the sort order of markets returned. By default we return a strict sort on 24 hour reported volume. Pass `cmc_rank` to return a CMC methodology based sort where markets with excluded volumes are returned last.',
            'enum' => [
                'volume_24h_strict',
                'cmc_rank',
                'cmc_rank_advanced',
                'effective_liquidity',
                'market_score',
                'market_reputation',
            ],
        ],
        'aux' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `num_market_pairs,category,fee_type,market_url,currency_name,currency_slug,price_quote,notice,cmc_rank,effective_liquidity,market_score,market_reputation` to include all auxiliary fields.',
        ],
        'matched_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally include one or more fiat or cryptocurrency IDs to filter market pairs by. For example `?id=1&matched_id=2781` would only return BTC markets that matched: "BTC/USD" or "USD/BTC". This parameter cannot be used when `matched_symbol` is used.',
        ],
        'matched_symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally include one or more fiat or cryptocurrency symbols to filter market pairs by. For example `?symbol=BTC&matched_symbol=USD` would only return BTC markets that matched: "BTC/USD" or "USD/BTC". This parameter cannot be used when `matched_id` is used.',
        ],
        'category' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The category of trading this market falls under. Spot markets are the most common but options include derivatives and OTC.',
            'enum' => [
                'all',
                'spot',
                'derivatives',
                'otc',
                'perpetual',
            ],
        ],
        'fee_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The fee type the exchange enforces for this market.',
            'enum' => [
                'all',
                'percentage',
                'no-fees',
                'transactional-mining',
                'unknown',
            ],
        ],
        'convert' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
        ],
        'convert_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v2/cryptocurrency/market-pairs/latest';
    protected const QUERY_PARAMS = [
        'id' => 'id',
        'slug' => 'slug',
        'symbol' => 'symbol',
        'start' => 'start',
        'limit' => 'limit',
        'sort_dir' => 'sort_dir',
        'sort' => 'sort',
        'aux' => 'aux',
        'matched_id' => 'matched_id',
        'matched_symbol' => 'matched_symbol',
        'category' => 'category',
        'fee_type' => 'fee_type',
        'convert' => 'convert',
        'convert_id' => 'convert_id',
    ];
    protected const BODY_REQUIRED = false;
}
