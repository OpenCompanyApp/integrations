<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Index Linked Plan Rebalance Details (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/lending/auto-invest/rebalance/history.
 */
class BinanceGetSapiV1LendingAutoInvestRebalanceHistory extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_lending_auto_invest_rebalance_history';
    protected const DESCRIPTION = 'Index Linked Plan Rebalance Details (USER_DATA)

Get the history of Index Linked Plan Redemption transactions Max 30 day difference between startTime and endTime If no startTime and endTime, default to show past 30 day records Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/rebalance/history.';
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
    protected const PATH = '/sapi/v1/lending/auto-invest/rebalance/history';
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
