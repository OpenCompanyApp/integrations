<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * CoinMarketCap ID Map.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/exchange/map.
 */
class CoinMarketCapGetV1ExchangeMap extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_exchange_map';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/exchange/map.';
    protected const PARAMETERS = [
        'listing_status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Only active exchanges are returned by default. Pass `inactive` to get a list of exchanges that are no longer active. Pass `untracked` to get a list of exchanges that are registered but do not currently meet methodology requirements to have active markets tracked. You may pass one or more comma-separated values.',
        ],
        'slug' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally pass a comma-separated list of exchange slugs (lowercase URL friendly shorthand name with spaces replaced with dashes) to return CoinMarketCap IDs for. If this option is passed, other options will be ignored.',
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
            'description' => 'What field to sort the list of exchanges by.',
            'enum' => [
                'volume_24h',
                'id',
            ],
        ],
        'aux' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `first_historical_data,last_historical_data,is_active,status` to include all auxiliary fields.',
        ],
        'crypto_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally include one fiat or cryptocurrency IDs to filter market pairs by. For example `?crypto_id=1` would only return exchanges that have BTC.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/exchange/map';
    protected const QUERY_PARAMS = [
        'listing_status' => 'listing_status',
        'slug' => 'slug',
        'start' => 'start',
        'limit' => 'limit',
        'sort' => 'sort',
        'aux' => 'aux',
        'crypto_id' => 'crypto_id',
    ];
    protected const BODY_REQUIRED = false;
}
