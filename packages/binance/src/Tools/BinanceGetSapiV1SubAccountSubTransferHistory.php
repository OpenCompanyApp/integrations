<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Sub-account Spot Asset Transfer History (For Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/sub-account/sub/transfer/history.
 */
class BinanceGetSapiV1SubAccountSubTransferHistory extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_sub_account_sub_transfer_history';
    protected const DESCRIPTION = 'Sub-account Spot Asset Transfer History (For Master Account)

- fromEmail and toEmail cannot be sent at the same time. - Return fromEmail equal master account email by default. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/sub-account/sub/transfer/history.';
    protected const PARAMETERS = [
        'from_email' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sub-account email',
        ],
        'to_email' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sub-account email',
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
            'description' => 'Default 1',
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
    protected const PATH = '/sapi/v1/sub-account/sub/transfer/history';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'fromEmail' => 'from_email',
        'toEmail' => 'to_email',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'page' => 'page',
        'limit' => 'limit',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
