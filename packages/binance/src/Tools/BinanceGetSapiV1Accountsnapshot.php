<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Daily Account Snapshot (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/accountSnapshot.
 */
class BinanceGetSapiV1Accountsnapshot extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_accountsnapshot';
    protected const DESCRIPTION = 'Daily Account Snapshot (USER_DATA)

- The query time period must be less than 30 days - Support query within the last one month only - If startTimeand endTime not sent, return records of the last 7 days by default Weight(IP): 2400

Official Binance Spot endpoint: GET /sapi/v1/accountSnapshot.';
    protected const PARAMETERS = [
        'type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `type`.',
            'enum' => [
                'SPOT',
                'MARGIN',
                'FUTURES',
            ],
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
            'description' => 'query parameter `limit`.',
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
    protected const PATH = '/sapi/v1/accountSnapshot';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
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
