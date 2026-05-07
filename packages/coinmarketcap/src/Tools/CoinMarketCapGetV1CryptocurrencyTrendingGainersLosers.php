<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Trending Gainers & Losers.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/cryptocurrency/trending/gainers-losers.
 */
class CoinMarketCapGetV1CryptocurrencyTrendingGainersLosers extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_cryptocurrency_trending_gainers_losers';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/trending/gainers-losers.';
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
            'description' => 'Adjusts the overall window of time for the biggest gainers and losers.',
            'enum' => [
                '1h',
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
        'sort' => [
            'type' => 'string',
            'required' => false,
            'description' => 'What field to sort the list of cryptocurrencies by.',
            'enum' => [
                'percent_change_24h',
            ],
        ],
        'sort_dir' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The direction in which to order cryptocurrencies against the specified sort.',
            'enum' => [
                'asc',
                'desc',
            ],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/cryptocurrency/trending/gainers-losers';
    protected const QUERY_PARAMS = [
        'start' => 'start',
        'limit' => 'limit',
        'time_period' => 'time_period',
        'convert' => 'convert',
        'convert_id' => 'convert_id',
        'sort' => 'sort',
        'sort_dir' => 'sort_dir',
    ];
    protected const BODY_REQUIRED = false;
}
