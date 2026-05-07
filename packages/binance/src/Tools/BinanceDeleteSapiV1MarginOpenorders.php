<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Margin Account Cancel all Open Orders on a Symbol (TRADE).
 *
 * Maps to the official Binance Spot endpoint DELETE /sapi/v1/margin/openOrders.
 */
class BinanceDeleteSapiV1MarginOpenorders extends AbstractBinanceTool
{
    protected const NAME = 'binance_delete_sapi_v1_margin_openorders';
    protected const DESCRIPTION = 'Margin Account Cancel all Open Orders on a Symbol (TRADE)

- Cancels all active orders on a symbol for margin account. - This includes OCO orders. Weight(IP): 1

Official Binance Spot endpoint: DELETE /sapi/v1/margin/openOrders.';
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
    protected const METHOD = 'DELETE';
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
