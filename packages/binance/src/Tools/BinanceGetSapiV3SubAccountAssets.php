<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Sub-account Assets (For Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v3/sub-account/assets.
 */
class BinanceGetSapiV3SubAccountAssets extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v3_sub_account_assets';
    protected const DESCRIPTION = 'Sub-account Assets (For Master Account)

Fetch sub-account assets Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v3/sub-account/assets.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Sub-account email',
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
    protected const PATH = '/sapi/v3/sub-account/assets';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
