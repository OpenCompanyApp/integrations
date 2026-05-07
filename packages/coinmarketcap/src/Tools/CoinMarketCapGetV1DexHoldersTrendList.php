<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Get holder trend list.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/dex/holders/trend/list.
 */
class CoinMarketCapGetV1DexHoldersTrendList extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_dex_holders_trend_list';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/holders/trend/list.';
    protected const PARAMETERS = [
        'platform' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Platform name or id',
        ],
        'tokenaddress' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Token  address',
        ],
        'interval' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Kline interval: 1d',
        ],
        'from' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'start timestamp',
        ],
        'to' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'End timestamp',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Number of to load',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/dex/holders/trend/list';
    protected const QUERY_PARAMS = [
        'platform' => 'platform',
        'tokenAddress' => 'tokenaddress',
        'interval' => 'interval',
        'from' => 'from',
        'to' => 'to',
        'limit' => 'limit',
    ];
    protected const BODY_REQUIRED = false;
}
