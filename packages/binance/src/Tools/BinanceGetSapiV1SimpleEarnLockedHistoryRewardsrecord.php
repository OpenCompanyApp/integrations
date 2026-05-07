<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Locked Rewards History (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/simple-earn/locked/history/rewardsRecord.
 */
class BinanceGetSapiV1SimpleEarnLockedHistoryRewardsrecord extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_simple_earn_locked_history_rewardsrecord';
    protected const DESCRIPTION = 'Get Locked Rewards History (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/locked/history/rewardsRecord.';
    protected const PARAMETERS = [
        'position_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `positionId`.',
        ],
        'asset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `asset`.',
        ],
        'start_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'end_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'size' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default:10 Max:100',
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
    protected const PATH = '/sapi/v1/simple-earn/locked/history/rewardsRecord';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'positionId' => 'position_id',
        'asset' => 'asset',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'size' => 'size',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
