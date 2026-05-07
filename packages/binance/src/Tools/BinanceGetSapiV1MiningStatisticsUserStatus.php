<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Statistic List (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/mining/statistics/user/status.
 */
class BinanceGetSapiV1MiningStatisticsUserStatus extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_mining_statistics_user_status';
    protected const DESCRIPTION = 'Statistic List (USER_DATA)

Weight(IP): 5

Official Binance Spot endpoint: GET /sapi/v1/mining/statistics/user/status.';
    protected const PARAMETERS = [
        'algo' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Algorithm(sha256)',
        ],
        'user_name' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Mining Account',
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
    protected const PATH = '/sapi/v1/mining/statistics/user/status';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'algo' => 'algo',
        'userName' => 'user_name',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
