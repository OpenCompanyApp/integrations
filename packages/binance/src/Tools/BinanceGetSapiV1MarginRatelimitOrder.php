<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Current Margin Order Count Usage (TRADE).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/rateLimit/order.
 */
class BinanceGetSapiV1MarginRatelimitOrder extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_ratelimit_order';
    protected const DESCRIPTION = 'Query Current Margin Order Count Usage (TRADE)

Displays the user\'s current margin order count usage for all intervals. Weight(IP): 20

Official Binance Spot endpoint: GET /sapi/v1/margin/rateLimit/order.';
    protected const PARAMETERS = [
        'is_isolated' => [
            'type' => 'string',
            'required' => false,
            'description' => '* `TRUE` - For isolated margin * `FALSE` - Default, not for isolated margin',
        ],
        'symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'isolated symbol, mandatory for isolated margin',
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
    protected const PATH = '/sapi/v1/margin/rateLimit/order';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'isIsolated' => 'is_isolated',
        'symbol' => 'symbol',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
