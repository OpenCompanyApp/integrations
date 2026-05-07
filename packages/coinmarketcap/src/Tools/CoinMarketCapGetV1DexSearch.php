<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Search tokens.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/dex/search.
 */
class CoinMarketCapGetV1DexSearch extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_dex_search';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/search.';
    protected const PARAMETERS = [
        'q' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Search keyword',
        ],
        'platform' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Platform filter',
        ],
        'sort' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sort field',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Result limit',
        ],
        'code' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Code filter',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/dex/search';
    protected const QUERY_PARAMS = [
        'q' => 'q',
        'platform' => 'platform',
        'sort' => 'sort',
        'limit' => 'limit',
        'code' => 'code',
    ];
    protected const BODY_REQUIRED = false;
}
