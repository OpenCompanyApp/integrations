<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Trading Day Ticker.
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/ticker/tradingDay.
 */
class BinanceGetApiV3TickerTradingday extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_ticker_tradingday';
    protected const DESCRIPTION = 'Trading Day Ticker

Price change statistics for a trading day. Notes: - Supported values for timeZone: - Hours and minutes (e.g. -1:00, 05:45) - Only hours (e.g. 0, 8, 4) Weight: - `4` for each requested symbol. - The weight for this request will cap at `200` once the number of symbols in the request is more than `50`.

Official Binance Spot endpoint: GET /api/v3/ticker/tradingDay.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
        'symbols' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `symbols`.',
        ],
        'time_zone' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default: 0 (UTC)',
        ],
        'type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Supported values: FULL or MINI. If none provided, the default is FULL',
            'enum' => [
                'FULL',
                'MINI',
            ],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/ticker/tradingDay';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'symbols' => 'symbols',
        'timeZone' => 'time_zone',
        'type' => 'type',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'public';
}
