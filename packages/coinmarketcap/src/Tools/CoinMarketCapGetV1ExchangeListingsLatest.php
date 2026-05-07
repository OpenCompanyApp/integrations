<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Exchange Listings Latest.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/exchange/listings/latest.
 */
class CoinMarketCapGetV1ExchangeListingsLatest extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_exchange_listings_latest';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/exchange/listings/latest.';
    protected const PARAMETERS = [
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
        'sort' => [
            'type' => 'string',
            'required' => false,
            'description' => 'What field to sort the list of exchanges by.',
            'enum' => [
                'name',
                'volume_24h',
                'volume_24h_adjusted',
                'exchange_score',
            ],
        ],
        'sort_dir' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The direction in which to order exchanges against the specified sort.',
            'enum' => [
                'asc',
                'desc',
            ],
        ],
        'market_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The type of exchange markets to include in rankings. This field is deprecated. Please use "all" for accurate sorting.',
            'enum' => [
                'fees',
                'no_fees',
                'all',
            ],
        ],
        'category' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The category for this exchange.',
            'enum' => [
                'all',
                'spot',
                'derivatives',
                'dex',
                'lending',
            ],
        ],
        'aux' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `num_market_pairs,traffic_score,rank,exchange_score,effective_liquidity_24h,date_launched,fiats` to include all auxiliary fields.',
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
    protected const PATH = '/v1/exchange/listings/latest';
    protected const QUERY_PARAMS = [
        'start' => 'start',
        'limit' => 'limit',
        'sort' => 'sort',
        'sort_dir' => 'sort_dir',
        'market_type' => 'market_type',
        'category' => 'category',
        'aux' => 'aux',
        'convert' => 'convert',
        'convert_id' => 'convert_id',
    ];
    protected const BODY_REQUIRED = false;
}
