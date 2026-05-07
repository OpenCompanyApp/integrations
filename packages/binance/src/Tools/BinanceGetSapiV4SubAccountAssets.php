<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Sub-account Assets (For Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v4/sub-account/assets.
 */
class BinanceGetSapiV4SubAccountAssets extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v4_sub_account_assets';
    protected const DESCRIPTION = 'Query Sub-account Assets (For Master Account)

Fetch sub-account assets Weight(UID): 60

Official Binance Spot endpoint: GET /sapi/v4/sub-account/assets.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `email`.',
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
    protected const PATH = '/sapi/v4/sub-account/assets';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
