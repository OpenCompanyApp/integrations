<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Managed Sub-account Margin Asset Details (For Investor Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/managed-subaccount/marginAsset.
 */
class BinanceGetSapiV1ManagedSubaccountMarginasset extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_managed_subaccount_marginasset';
    protected const DESCRIPTION = 'Query Managed Sub-account Margin Asset Details (For Investor Master Account)

Investor can use this api to query managed sub account margin asset details

Official Binance Spot endpoint: GET /sapi/v1/managed-subaccount/marginAsset.';
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
    protected const PATH = '/sapi/v1/managed-subaccount/marginAsset';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
