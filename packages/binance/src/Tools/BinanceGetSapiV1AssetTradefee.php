<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Trade Fee (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/asset/tradeFee.
 */
class BinanceGetSapiV1AssetTradefee extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_asset_tradefee';
    protected const DESCRIPTION = 'Trade Fee (USER_DATA)

Fetch trade fee Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/asset/tradeFee.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => false,
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
    protected const PATH = '/sapi/v1/asset/tradeFee';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
