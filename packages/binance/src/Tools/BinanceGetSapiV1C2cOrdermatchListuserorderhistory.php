<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get C2C Trade History (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/c2c/orderMatch/listUserOrderHistory.
 */
class BinanceGetSapiV1C2cOrdermatchListuserorderhistory extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_c2c_ordermatch_listuserorderhistory';
    protected const DESCRIPTION = 'Get C2C Trade History (USER_DATA)

- If startTimestamp and endTimestamp are not sent, the recent 30-day data will be returned. - The max interval between startTimestamp and endTimestamp is 30 days. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/c2c/orderMatch/listUserOrderHistory.';
    protected const PARAMETERS = [
        'trade_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `tradeType`.',
            'enum' => [
                'BUY',
                'SELL',
            ],
        ],
        'start_timestamp' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'end_timestamp' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'page' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 1',
        ],
        'rows' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'default 100, max 100',
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
    protected const PATH = '/sapi/v1/c2c/orderMatch/listUserOrderHistory';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'tradeType' => 'trade_type',
        'startTimestamp' => 'start_timestamp',
        'endTimestamp' => 'end_timestamp',
        'page' => 'page',
        'rows' => 'rows',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
