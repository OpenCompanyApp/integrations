<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Current Order Count Usage (TRADE).
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/rateLimit/order.
 */
class BinanceGetApiV3RatelimitOrder extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_ratelimit_order';
    protected const DESCRIPTION = 'Query Current Order Count Usage (TRADE)

Displays the user\'s current order count usage for all intervals. Weight(IP): 40

Official Binance Spot endpoint: GET /api/v3/rateLimit/order.';
    protected const PARAMETERS = [
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
    protected const PATH = '/api/v3/rateLimit/order';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
