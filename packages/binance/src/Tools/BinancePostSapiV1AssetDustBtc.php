<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Assets That Can Be Converted Into BNB (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/asset/dust-btc.
 */
class BinancePostSapiV1AssetDustBtc extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_asset_dust_btc';
    protected const DESCRIPTION = 'Get Assets That Can Be Converted Into BNB (USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/asset/dust-btc.';
    protected const PARAMETERS = [
        'account_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'SPOT or MARGIN, default SPOT',
            'enum' => [
                'SPOT',
                'MARGIN',
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
    protected const PATH = '/sapi/v1/asset/dust-btc';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'accountType' => 'account_type',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
