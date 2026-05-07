<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get NFT Asset (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/nft/user/getAsset.
 */
class BinanceGetSapiV1NftUserGetasset extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_nft_user_getasset';
    protected const DESCRIPTION = 'Get NFT Asset (USER_DATA)

Weight(UID): 3000

Official Binance Spot endpoint: GET /sapi/v1/nft/user/getAsset.';
    protected const PARAMETERS = [
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 50, Max 50',
        ],
        'page' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 1',
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
    protected const PATH = '/sapi/v1/nft/user/getAsset';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'limit' => 'limit',
        'page' => 'page',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
