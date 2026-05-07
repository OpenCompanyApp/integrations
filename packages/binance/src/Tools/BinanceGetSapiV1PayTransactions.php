<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Pay Trade History (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/pay/transactions.
 */
class BinanceGetSapiV1PayTransactions extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_pay_transactions';
    protected const DESCRIPTION = 'Get Pay Trade History (USER_DATA)

- If startTime and endTime are not sent, the recent 90 days\' data will be returned. - The max interval between startTime and endTime is 90 days. - Support for querying orders within the last 18 months. Weight(UID): 3000

Official Binance Spot endpoint: GET /sapi/v1/pay/transactions.';
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
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'default 100, max 100',
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
    protected const PATH = '/sapi/v1/pay/transactions';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'limit' => 'limit',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
