<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * UIKlines.
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/uiKlines.
 */
class BinanceGetApiV3Uiklines extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_uiklines';
    protected const DESCRIPTION = 'UIKlines

The request is similar to klines having the same parameters and response. uiKlines return modified kline data, optimized for presentation of candlestick charts. Weight(IP): 2

Official Binance Spot endpoint: GET /api/v3/uiKlines.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
        'interval' => [
            'type' => 'string',
            'required' => true,
            'description' => 'kline intervals',
            'enum' => [
                '1s',
                '1m',
                '3m',
                '5m',
                '15m',
                '30m',
                '1h',
                '2h',
                '4h',
                '6h',
                '8h',
                '12h',
                '1d',
                '3d',
                '1w',
                '1M',
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
        'time_zone' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default: 0 (UTC)',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 500; max 1000.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/uiKlines';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'interval' => 'interval',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'timeZone' => 'time_zone',
        'limit' => 'limit',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'public';
}
