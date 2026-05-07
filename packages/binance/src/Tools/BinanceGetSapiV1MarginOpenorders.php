<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Margin Account's Open Orders (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/openOrders.
 */
class BinanceGetSapiV1MarginOpenorders extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_openorders';
    protected const DESCRIPTION = 'Query Margin Account\'s Open Orders (USER_DATA)

- If the `symbol` is not sent, orders for all symbols will be returned in an array. - When all symbols are returned, the number of requests counted against the rate limiter is equal to the number of symbols currently trading on the exchange - If isIsolated ="TRUE", symbol must be sent. Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/openOrders.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => false,
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
    protected const PATH = '/sapi/v1/margin/openOrders';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'isIsolated' => 'is_isolated',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
