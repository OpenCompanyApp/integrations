<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * CoinMarketCap ID Map.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/cryptocurrency/map.
 */
class CoinMarketCapGetV1CryptocurrencyMap extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_cryptocurrency_map';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/map.';
    protected const PARAMETERS = [
        'listing_status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Only active cryptocurrencies are returned by default. Pass `inactive` to get a list of cryptocurrencies that are no longer active. Pass `untracked` to get a list of cryptocurrencies that are listed but do not yet meet methodology requirements to have tracked markets available. You may pass one or more comma-separated values.',
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
        'sort' => [
            'type' => 'string',
            'required' => false,
            'description' => 'What field to sort the list of cryptocurrencies by.',
            'enum' => [
                'cmc_rank',
                'id',
            ],
        ],
        'symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally pass a comma-separated list of cryptocurrency symbols to return CoinMarketCap IDs for. If this option is passed, other options will be ignored.',
        ],
        'aux' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `platform,first_historical_data,last_historical_data,is_active,status` to include all auxiliary fields.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/cryptocurrency/map';
    protected const QUERY_PARAMS = [
        'listing_status' => 'listing_status',
        'start' => 'start',
        'limit' => 'limit',
        'sort' => 'sort',
        'symbol' => 'symbol',
        'aux' => 'aux',
    ];
    protected const BODY_REQUIRED = false;
}
