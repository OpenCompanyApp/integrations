<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Asset Dividend Record (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/asset/assetDividend.
 */
class BinanceGetSapiV1AssetAssetdividend extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_asset_assetdividend';
    protected const DESCRIPTION = 'Asset Dividend Record (USER_DATA)

Query asset Dividend Record Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/asset/assetDividend.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `asset`.',
        ],
        'start_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'end_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `limit`.',
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
    protected const PATH = '/sapi/v1/asset/assetDividend';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'limit' => 'limit',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
