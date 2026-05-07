<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Kline/Candlestick Data.
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/klines.
 */
class BinanceGetApiV3Klines extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_klines';
    protected const DESCRIPTION = 'Kline/Candlestick Data

Kline/candlestick bars for a symbol. Klines are uniquely identified by their open time. - If `startTime` and `endTime` are not sent, the most recent klines are returned. Weight(IP): 2

Official Binance Spot endpoint: GET /api/v3/klines.';
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
    protected const PATH = '/api/v3/klines';
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
