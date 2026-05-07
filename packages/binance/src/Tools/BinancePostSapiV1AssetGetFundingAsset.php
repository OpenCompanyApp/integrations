<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Funding Wallet (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/asset/get-funding-asset.
 */
class BinancePostSapiV1AssetGetFundingAsset extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_asset_get_funding_asset';
    protected const DESCRIPTION = 'Funding Wallet (USER_DATA)

- Currently supports querying the following business assets：Binance Pay, Binance Card, Binance Gift Card, Stock Token Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/asset/get-funding-asset.';
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
    protected const PATH = '/sapi/v1/asset/get-funding-asset';
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
