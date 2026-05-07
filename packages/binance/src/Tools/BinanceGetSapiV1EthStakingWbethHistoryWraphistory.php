<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get WBETH wrap history (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/eth-staking/wbeth/history/wrapHistory.
 */
class BinanceGetSapiV1EthStakingWbethHistoryWraphistory extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_eth_staking_wbeth_history_wraphistory';
    protected const DESCRIPTION = 'Get WBETH wrap history (USER_DATA)

- The time between startTime and endTime cannot be longer than 3 months. - If startTime and endTime are both not sent, then the last 30 days\' data will be returned. - If startTime is sent but endTime is not sent, the next 30 days\' data beginning from startTime will be returned. - If endTime is sent but startTime is not sent, the 30 days\' data before endTime will be returned. Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/eth-staking/wbeth/history/wrapHistory.';
    protected const PARAMETERS = [
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
        'current' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Current querying page. Start from 1. Default:1',
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
    protected const PATH = '/sapi/v1/eth-staking/wbeth/history/wrapHistory';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'current' => 'current',
        'size' => 'size',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
