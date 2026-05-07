<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Margin Account's Trade List (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/myTrades.
 */
class BinanceGetSapiV1MarginMytrades extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_mytrades';
    protected const DESCRIPTION = 'Query Margin Account\'s Trade List (USER_DATA)

- If `fromId` is set, it will get orders >= that `fromId`. Otherwise most recent trades are returned. Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/myTrades.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
        'is_isolated' => [
            'type' => 'string',
            'required' => false,
            'description' => '* `TRUE` - For isolated margin * `FALSE` - Default, not for isolated margin',
            'enum' => [
                'TRUE',
                'FALSE',
            ],
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
        'from_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Trade id to fetch from. Default gets most recent trades.',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 500; max 1000.',
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
    protected const PATH = '/sapi/v1/margin/myTrades';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'isIsolated' => 'is_isolated',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'fromId' => 'from_id',
        'limit' => 'limit',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
