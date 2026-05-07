<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Account Trade List (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/myTrades.
 */
class BinanceGetApiV3Mytrades extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_mytrades';
    protected const DESCRIPTION = 'Account Trade List (USER_DATA)

Get trades for a specific account and symbol. If `fromId` is set, it will get id >= that `fromId`. Otherwise most recent orders are returned. The time between startTime and endTime can\'t be longer than 24 hours. These are the supported combinations of all parameters: symbol symbol + orderId symbol + startTime symbol + endTime symbol + fromId symbol + startTime + endTime symbol+ orderId + fromId Weight(IP): 20

Official Binance Spot endpoint: GET /api/v3/myTrades.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
        'order_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'This can only be used in combination with symbol.',
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
    protected const PATH = '/api/v3/myTrades';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'orderId' => 'order_id',
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
