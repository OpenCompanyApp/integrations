<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Managed sub-account asset details(For Investor Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/managed-subaccount/asset.
 */
class BinanceGetSapiV1ManagedSubaccountAsset extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_managed_subaccount_asset';
    protected const DESCRIPTION = 'Managed sub-account asset details(For Investor Master Account)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/managed-subaccount/asset.';
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
    protected const PATH = '/sapi/v1/managed-subaccount/asset';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
