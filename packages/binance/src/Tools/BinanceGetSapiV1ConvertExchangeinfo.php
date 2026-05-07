<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * List All Convert Pairs.
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/convert/exchangeInfo.
 */
class BinanceGetSapiV1ConvertExchangeinfo extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_convert_exchangeinfo';
    protected const DESCRIPTION = 'List All Convert Pairs

Query for all convertible token pairs and the tokens’ respective upper/lower limits Weight(IP): 3000

Official Binance Spot endpoint: GET /sapi/v1/convert/exchangeInfo.';
    protected const PARAMETERS = [
        'from_asset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'User spends coin',
        ],
        'to_asset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'User receives coin',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/convert/exchangeInfo';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'fromAsset' => 'from_asset',
        'toAsset' => 'to_asset',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'public';
}
