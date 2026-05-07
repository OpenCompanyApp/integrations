<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Sub-account Transfer History (For Sub-account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/sub-account/transfer/subUserHistory.
 */
class BinanceGetSapiV1SubAccountTransferSubuserhistory extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_sub_account_transfer_subuserhistory';
    protected const DESCRIPTION = 'Sub-account Transfer History (For Sub-account)

- If `type` is not sent, the records of type 2: transfer out will be returned by default. - If `startTime` and `endTime` are not sent, the recent 30-day data will be returned. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/sub-account/transfer/subUserHistory.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `asset`.',
        ],
        'type' => [
            'type' => 'integer',
            'required' => false,
            'description' => '* `1` - transfer in * `2` - transfer out',
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
    protected const PATH = '/sapi/v1/sub-account/transfer/subUserHistory';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
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
