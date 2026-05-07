<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get All Margin Assets (MARKET_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/allAssets.
 */
class BinanceGetSapiV1MarginAllassets extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_allassets';
    protected const DESCRIPTION = 'Get All Margin Assets (MARKET_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/margin/allAssets.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `asset`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/margin/allAssets';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}
