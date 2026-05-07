<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Trending Most Visited.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/cryptocurrency/trending/most-visited.
 */
class CoinMarketCapGetV1CryptocurrencyTrendingMostVisited extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_cryptocurrency_trending_most_visited';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/trending/most-visited.';
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
        'time_period' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Adjusts the overall window of time for most visited currencies.',
            'enum' => [
                '24h',
                '30d',
                '7d',
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
    protected const PATH = '/v1/cryptocurrency/trending/most-visited';
    protected const QUERY_PARAMS = [
        'start' => 'start',
        'limit' => 'limit',
        'time_period' => 'time_period',
        'convert' => 'convert',
        'convert_id' => 'convert_id',
    ];
    protected const BODY_REQUIRED = false;
}
