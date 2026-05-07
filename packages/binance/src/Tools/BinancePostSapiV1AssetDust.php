<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Dust Transfer (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/asset/dust.
 */
class BinancePostSapiV1AssetDust extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_asset_dust';
    protected const DESCRIPTION = 'Dust Transfer (USER_DATA)

Convert dust assets to BNB. Weight(UID): 10

Official Binance Spot endpoint: POST /sapi/v1/asset/dust.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'array',
            'required' => true,
            'description' => 'The asset being converted. For example, asset=BTC&asset=USDT',
            'items' => [
                'type' => 'string',
            ],
        ],
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
    protected const PATH = '/sapi/v1/asset/dust';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'accountType' => 'account_type',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
