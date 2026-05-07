<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Rolling window price change statistics.
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/ticker.
 */
class BinanceGetApiV3Ticker extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_ticker';
    protected const DESCRIPTION = 'Rolling window price change statistics

The window used to compute statistics is typically slightly wider than requested windowSize. openTime for /api/v3/ticker always starts on a minute, while the closeTime is the current time of the request. As such, the effective window might be up to 1 minute wider than requested. E.g. If the closeTime is 1641287867099 (January 04, 2022 09:17:47:099 UTC) , and the windowSize is 1d. the openTime will be: 1641201420000 (January 3, 2022, 09:17:00 UTC) Weight(IP): 4 for each requested symbol regardless of windowSize. The weight for this request will cap at 200 once the number of symbols in the request is more than 50.

Official Binance Spot endpoint: GET /api/v3/ticker.';
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
        'window_size' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Defaults to 1d if no parameter provided. Supported windowSize values: 1m,2m....59m for minutes 1h, 2h....23h - for hours 1d...7d - for days. Units cannot be combined (e.g. 1d2h is not allowed)',
        ],
        'type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Supported values: FULL or MINI. If none provided, the default is FULL',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/ticker';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'symbols' => 'symbols',
        'windowSize' => 'window_size',
        'type' => 'type',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'public';
}
