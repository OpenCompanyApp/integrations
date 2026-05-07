<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Recent Trades List.
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/trades.
 */
class BinanceGetApiV3Trades extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_trades';
    protected const DESCRIPTION = 'Recent Trades List

Get recent trades. Weight(IP): 10

Official Binance Spot endpoint: GET /api/v3/trades.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 500; max 1000.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/trades';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'limit' => 'limit',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'public';
}
