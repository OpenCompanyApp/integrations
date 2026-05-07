<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get All Cross Margin Pairs (MARKET_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/allPairs.
 */
class BinanceGetSapiV1MarginAllpairs extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_allpairs';
    protected const DESCRIPTION = 'Get All Cross Margin Pairs (MARKET_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/margin/allPairs.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/margin/allPairs';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}
