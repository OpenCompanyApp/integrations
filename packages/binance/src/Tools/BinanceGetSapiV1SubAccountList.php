<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Sub-account List (For Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/sub-account/list.
 */
class BinanceGetSapiV1SubAccountList extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_sub_account_list';
    protected const DESCRIPTION = 'Query Sub-account List (For Master Account)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/sub-account/list.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sub-account email',
        ],
        'is_freeze' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `isFreeze`.',
            'enum' => [
                'true',
                'false',
            ],
        ],
        'page' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 1',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 1; max 200',
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
    protected const PATH = '/sapi/v1/sub-account/list';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'isFreeze' => 'is_freeze',
        'page' => 'page',
        'limit' => 'limit',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
