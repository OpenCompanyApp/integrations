<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Managed Sub Account Transfer Log (For Trading Team Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/managed-subaccount/queryTransLogForTradeParent.
 */
class BinanceGetSapiV1ManagedSubaccountQuerytranslogfortradeparent extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_managed_subaccount_querytranslogfortradeparent';
    protected const DESCRIPTION = 'Query Managed Sub Account Transfer Log (For Trading Team Master Account)

Trading team can use this api to query managed sub account transfer log. This endpoint is available for trading team of Managed Sub-Account. A Managed Sub-Account is an account type for investors who value flexibility in asset allocation and account application, while delegating trades to a professional trading team Weight(IP): 60

Official Binance Spot endpoint: GET /sapi/v1/managed-subaccount/queryTransLogForTradeParent.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `email`.',
        ],
        'start_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'end_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
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
        'transfers' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Transfer Direction (FROM/TO)',
        ],
        'transfer_function_account_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Transfer function account type (SPOT/MARGIN/ISOLATED_MARGIN/USDT_FUTURE/COIN_FUTURE)',
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
    protected const PATH = '/sapi/v1/managed-subaccount/queryTransLogForTradeParent';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'page' => 'page',
        'limit' => 'limit',
        'transfers' => 'transfers',
        'transferFunctionAccountType' => 'transfer_function_account_type',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
