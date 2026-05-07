<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Margin PriceIndex (MARKET_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/priceIndex.
 */
class BinanceGetSapiV1MarginPriceindex extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_priceindex';
    protected const DESCRIPTION = 'Query Margin PriceIndex (MARKET_DATA)

Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/priceIndex.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/margin/priceIndex';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}
