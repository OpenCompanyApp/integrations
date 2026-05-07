<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * 24hr Ticker Price Change Statistics.
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/ticker/24hr.
 */
class BinanceGetApiV3Ticker24hr extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_ticker_24hr';
    protected const DESCRIPTION = '24hr Ticker Price Change Statistics

24 hour rolling window price change statistics. Careful when accessing this with no symbol. - If the symbol is not sent, tickers for all symbols will be returned in an array. Weight(IP): - `2` for a single symbol; - `80` when the symbol parameter is omitted;

Official Binance Spot endpoint: GET /api/v3/ticker/24hr.';
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
    protected const PATH = '/api/v3/ticker/24hr';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'symbols' => 'symbols',
        'type' => 'type',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'public';
}
