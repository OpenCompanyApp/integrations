<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Index Linked Plan Position Details(USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/lending/auto-invest/index/user-summary.
 */
class BinanceGetSapiV1LendingAutoInvestIndexUserSummary extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_lending_auto_invest_index_user_summary';
    protected const DESCRIPTION = 'Query Index Linked Plan Position Details(USER_DATA)

Details on users Index-Linked plan position details Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/index/user-summary.';
    protected const PARAMETERS = [
        'index_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'query parameter `indexId`.',
        ],
        'recv_window' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The value cannot be greater than 60000',
        ],
        'timestamp' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/lending/auto-invest/index/user-summary';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'indexId' => 'index_id',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
