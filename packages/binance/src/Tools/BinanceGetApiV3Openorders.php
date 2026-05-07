<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Current Open Orders (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/openOrders.
 */
class BinanceGetApiV3Openorders extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_openorders';
    protected const DESCRIPTION = 'Current Open Orders (USER_DATA)

Get all open orders on a symbol. Careful when accessing this with no symbol. Weight(IP): - `6` for a single symbol; - `80` when the symbol parameter is omitted;

Official Binance Spot endpoint: GET /api/v3/openOrders.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => false,
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
    protected const METHOD = 'GET';
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
