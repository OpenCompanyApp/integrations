<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Get liquidity change list.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/dex/liquidity-change/list.
 */
class CoinMarketCapGetV1DexLiquidityChangeList extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_dex_liquidity_change_list';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/liquidity-change/list.';
    protected const PARAMETERS = [
        'platform' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Blockchain platform name (bsc/sol/etc)',
        ],
        'address' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Token contract address',
        ],
        'type' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Liquidity change type',
        ],
        'maker' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Maker address, support comma separated list',
        ],
        'sortby' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Field to sort by (currently only supports \'ts\')',
        ],
        'sorttype' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sort direction (\'asc\' or \'desc\', default is \'desc\')',
        ],
        'starttime' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Start timestamp (inclusive)',
        ],
        'endtime' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'End timestamp (inclusive)',
        ],
        'minvolume' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Minimum USD volume (inclusive)',
        ],
        'maxvolume' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Maximum USD volume (inclusive)',
        ],
        'lastid' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Cursor for pagination, format: ts_txHash_logId',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Result limit',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/dex/liquidity-change/list';
    protected const QUERY_PARAMS = [
        'platform' => 'platform',
        'address' => 'address',
        'type' => 'type',
        'maker' => 'maker',
        'sortBy' => 'sortby',
        'sortType' => 'sorttype',
        'startTime' => 'starttime',
        'endTime' => 'endtime',
        'minVolume' => 'minvolume',
        'maxVolume' => 'maxvolume',
        'lastId' => 'lastid',
        'limit' => 'limit',
    ];
    protected const BODY_REQUIRED = false;
}
