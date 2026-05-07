<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Asset Detail (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/asset/assetDetail.
 */
class BinanceGetSapiV1AssetAssetdetail extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_asset_assetdetail';
    protected const DESCRIPTION = 'Asset Detail (USER_DATA)

Fetch details of assets supported on Binance. - Please get network and other deposit or withdraw details from `GET /sapi/v1/capital/config/getall`. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/asset/assetDetail.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `asset`.',
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
    protected const PATH = '/sapi/v1/asset/assetDetail';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
