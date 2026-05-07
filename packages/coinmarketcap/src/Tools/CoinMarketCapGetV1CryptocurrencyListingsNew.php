<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Listings New.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/cryptocurrency/listings/new.
 */
class CoinMarketCapGetV1CryptocurrencyListingsNew extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_cryptocurrency_listings_new';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/listings/new.';
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
    protected const PATH = '/v1/cryptocurrency/listings/new';
    protected const QUERY_PARAMS = [
        'start' => 'start',
        'limit' => 'limit',
        'convert' => 'convert',
        'convert_id' => 'convert_id',
        'sort_dir' => 'sort_dir',
    ];
    protected const BODY_REQUIRED = false;
}
