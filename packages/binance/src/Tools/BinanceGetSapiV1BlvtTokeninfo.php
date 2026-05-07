<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * BLVT Info (MARKET_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/blvt/tokenInfo.
 */
class BinanceGetSapiV1BlvtTokeninfo extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_blvt_tokeninfo';
    protected const DESCRIPTION = 'BLVT Info (MARKET_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/blvt/tokenInfo.';
    protected const PARAMETERS = [
        'token_name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'BTCDOWN, BTCUP',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/blvt/tokenInfo';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'tokenName' => 'token_name',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}
