<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * User Asset (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v3/asset/getUserAsset.
 */
class BinancePostSapiV3AssetGetuserasset extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v3_asset_getuserasset';
    protected const DESCRIPTION = 'User Asset (USER_DATA)

Get user assets, just for positive data. Weight(IP): 5

Official Binance Spot endpoint: POST /sapi/v3/asset/getUserAsset.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `asset`.',
        ],
        'need_btc_valuation' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `needBtcValuation`.',
            'enum' => [
                'true',
                'false',
            ],
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
    protected const METHOD = 'POST';
    protected const PATH = '/sapi/v3/asset/getUserAsset';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'needBtcValuation' => 'need_btc_valuation',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
