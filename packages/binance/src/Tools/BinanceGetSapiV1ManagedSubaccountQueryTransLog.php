<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Managed Sub Account Transfer Log (For Trading Team Sub Account)(USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/managed-subaccount/query-trans-log.
 */
class BinanceGetSapiV1ManagedSubaccountQueryTransLog extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_managed_subaccount_query_trans_log';
    protected const DESCRIPTION = 'Query Managed Sub Account Transfer Log (For Trading Team Sub Account)(USER_DATA)

Query Managed Sub Account Transfer Log (For Trading Team Sub Account) Weight(UID): 60

Official Binance Spot endpoint: GET /sapi/v1/managed-subaccount/query-trans-log.';
    protected const PARAMETERS = [
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
            'required' => true,
            'description' => 'Transfer Direction',
            'enum' => [
                'FROM',
                'TO',
            ],
        ],
        'transfer_function_account_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Transfer function account type',
            'enum' => [
                'SPOT',
                'MARGIN',
                'ISOLATED_MARGIN',
                'USDT_FUTURE',
                'COIN_FUTURE',
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
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/managed-subaccount/query-trans-log';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
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
