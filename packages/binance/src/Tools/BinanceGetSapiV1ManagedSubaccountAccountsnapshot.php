<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Managed sub-account snapshot (For Investor Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/managed-subaccount/accountSnapshot.
 */
class BinanceGetSapiV1ManagedSubaccountAccountsnapshot extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_managed_subaccount_accountsnapshot';
    protected const DESCRIPTION = 'Managed sub-account snapshot (For Investor Master Account)

- The query time period must be less then 30 days - Support query within the last one month only - If `startTime` and `endTime` not sent, return records of the last 7 days by default Weight(IP): 2400

Official Binance Spot endpoint: GET /sapi/v1/managed-subaccount/accountSnapshot.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Sub-account email',
        ],
        'type' => [
            'type' => 'string',
            'required' => true,
            'description' => '"SPOT", "MARGIN"(cross), "FUTURES"(UM)',
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
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'min 7, max 30, default 7',
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
    protected const PATH = '/sapi/v1/managed-subaccount/accountSnapshot';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'type' => 'type',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'limit' => 'limit',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
