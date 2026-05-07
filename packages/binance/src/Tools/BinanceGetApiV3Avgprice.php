<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Current Average Price.
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/avgPrice.
 */
class BinanceGetApiV3Avgprice extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_avgprice';
    protected const DESCRIPTION = 'Current Average Price

Current average price for a symbol. Weight(IP): 2

Official Binance Spot endpoint: GET /api/v3/avgPrice.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/avgPrice';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'public';
}
