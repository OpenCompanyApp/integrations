<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Managed Sub-account List (For Investor).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/managed-subaccount/info.
 */
class BinanceGetSapiV1ManagedSubaccountInfo extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_managed_subaccount_info';
    protected const DESCRIPTION = 'Query Managed Sub-account List (For Investor)

Get investor\'s managed sub-account list. Weight(UID): 60

Official Binance Spot endpoint: GET /sapi/v1/managed-subaccount/info.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `email`.',
        ],
        'page' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 1',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 500; max 1000.',
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
    protected const PATH = '/sapi/v1/managed-subaccount/info';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'page' => 'page',
        'limit' => 'limit',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
