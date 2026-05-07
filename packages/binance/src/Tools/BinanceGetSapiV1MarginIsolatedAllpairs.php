<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get All Isolated Margin Symbol(USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/isolated/allPairs.
 */
class BinanceGetSapiV1MarginIsolatedAllpairs extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_isolated_allpairs';
    protected const DESCRIPTION = 'Get All Isolated Margin Symbol(USER_DATA)

Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/isolated/allPairs.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
        'recv_window' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The value cannot be greater than 60000',
        ],
        'timestamp' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/margin/isolated/allPairs';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
