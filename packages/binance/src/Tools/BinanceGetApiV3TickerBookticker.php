<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Symbol Order Book Ticker.
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/ticker/bookTicker.
 */
class BinanceGetApiV3TickerBookticker extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_ticker_bookticker';
    protected const DESCRIPTION = 'Symbol Order Book Ticker

Best price/qty on the order book for a symbol or symbols. - If the symbol is not sent, bookTickers for all symbols will be returned in an array. Weight(IP): - `2` for a single symbol; - `4` when the symbol parameter is omitted;

Official Binance Spot endpoint: GET /api/v3/ticker/bookTicker.';
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/ticker/bookTicker';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'symbols' => 'symbols',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'public';
}
