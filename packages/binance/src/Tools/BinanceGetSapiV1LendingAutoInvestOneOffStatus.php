<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query One-Time Transaction Status (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/lending/auto-invest/one-off/status.
 */
class BinanceGetSapiV1LendingAutoInvestOneOffStatus extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_lending_auto_invest_one_off_status';
    protected const DESCRIPTION = 'Query One-Time Transaction Status (USER_DATA)

Transaction status for one-time transaction Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/one-off/status.';
    protected const PARAMETERS = [
        'transaction_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'query parameter `transactionId`.',
        ],
        'request_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `requestId`.',
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
    protected const PATH = '/sapi/v1/lending/auto-invest/one-off/status';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'transactionId' => 'transaction_id',
        'requestId' => 'request_id',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
