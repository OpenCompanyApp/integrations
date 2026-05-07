<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Cancel all Open Orders on a Symbol (TRADE).
 *
 * Maps to the official Binance Spot endpoint DELETE /api/v3/openOrders.
 */
class BinanceDeleteApiV3Openorders extends AbstractBinanceTool
{
    protected const NAME = 'binance_delete_api_v3_openorders';
    protected const DESCRIPTION = 'Cancel all Open Orders on a Symbol (TRADE)

Cancels all active orders on a symbol. This includes OCO orders. Weight(IP): 1

Official Binance Spot endpoint: DELETE /api/v3/openOrders.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
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
    protected const PATH = '/api/v3/openOrders';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
