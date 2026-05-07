<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Get swap list.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/dex/tokens/transactions.
 */
class CoinMarketCapGetV1DexTokensTransactions extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_dex_tokens_transactions';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/tokens/transactions.';
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
            'description' => 'Transaction type (0 for buy, 1 for sell)',
        ],
        'types' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Transaction types filter, supports: buy, sell, open, close, add, reduce',
            'items' => [
                'type' => 'string',
            ],
        ],
        'maker' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Maker address, support comma separated list',
        ],
        'sortby' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Field to sort by (currently only supports \'time\')',
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
            'description' => 'Minimum volume (inclusive)',
        ],
        'maxvolume' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Maximum volume (inclusive)',
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
        'version' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Version',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/dex/tokens/transactions';
    protected const QUERY_PARAMS = [
        'platform' => 'platform',
        'address' => 'address',
        'type' => 'type',
        'types' => 'types',
        'maker' => 'maker',
        'sortBy' => 'sortby',
        'sortType' => 'sorttype',
        'startTime' => 'starttime',
        'endTime' => 'endtime',
        'minVolume' => 'minvolume',
        'maxVolume' => 'maxvolume',
        'lastId' => 'lastid',
        'limit' => 'limit',
        'version' => 'version',
    ];
    protected const BODY_REQUIRED = false;
}
