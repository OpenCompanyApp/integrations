<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Fiat ID Map.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/fiat/map.
 */
class CoinMarketCapGetV1FiatMap extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_fiat_map';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/fiat/map.';
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
            'description' => 'What field to sort the list by.',
            'enum' => [
                'name',
                'id',
            ],
        ],
        'include_metals' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Pass `true` to include precious metals.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/fiat/map';
    protected const QUERY_PARAMS = [
        'start' => 'start',
        'limit' => 'limit',
        'sort' => 'sort',
        'include_metals' => 'include_metals',
    ];
    protected const BODY_REQUIRED = false;
}
