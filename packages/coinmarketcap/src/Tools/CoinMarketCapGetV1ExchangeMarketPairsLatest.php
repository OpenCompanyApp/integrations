<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Market Pairs Latest.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/exchange/market-pairs/latest.
 */
class CoinMarketCapGetV1ExchangeMarketPairsLatest extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_exchange_market_pairs_latest';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/exchange/market-pairs/latest.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A CoinMarketCap exchange ID. Example: "1"',
        ],
        'slug' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively pass an exchange "slug" (URL friendly all lowercase shorthand version of name with spaces replaced with hyphens). Example: "binance". One "id" *or* "slug" is required.',
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
        'aux' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `num_market_pairs,category,fee_type,market_url,currency_name,currency_slug,price_quote,effective_liquidity,market_score,market_reputation` to include all auxiliary fields.',
        ],
        'matched_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally include one or more comma-delimited fiat or cryptocurrency IDs to filter market pairs by. For example `?matched_id=2781` would only return BTC markets that matched: "BTC/USD" or "USD/BTC" for the requested exchange. This parameter cannot be used when `matched_symbol` is used.',
        ],
        'matched_symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally include one or more comma-delimited fiat or cryptocurrency symbols to filter market pairs by. For example `?matched_symbol=USD` would only return BTC markets that matched: "BTC/USD" or "USD/BTC" for the requested exchange. This parameter cannot be used when `matched_id` is used.',
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
                'futures',
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
    protected const PATH = '/v1/exchange/market-pairs/latest';
    protected const QUERY_PARAMS = [
        'id' => 'id',
        'slug' => 'slug',
        'start' => 'start',
        'limit' => 'limit',
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
