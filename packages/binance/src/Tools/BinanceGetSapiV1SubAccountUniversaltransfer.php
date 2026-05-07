<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Universal Transfer History (For Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/sub-account/universalTransfer.
 */
class BinanceGetSapiV1SubAccountUniversaltransfer extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_sub_account_universaltransfer';
    protected const DESCRIPTION = 'Universal Transfer History (For Master Account)

- `fromEmail` and `toEmail` cannot be sent at the same time. - Return `fromEmail` equal master account email by default. - The query time period must be less then 30 days. - If startTime and endTime not sent, return records of the last 30 days by default. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/sub-account/universalTransfer.';
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
        'client_tran_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `clientTranId`.',
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
            'description' => 'Default 500, Max 500',
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
    protected const PATH = '/sapi/v1/sub-account/universalTransfer';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'fromEmail' => 'from_email',
        'toEmail' => 'to_email',
        'clientTranId' => 'client_tran_id',
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
