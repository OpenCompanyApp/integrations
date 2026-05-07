<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Fiat Payments History (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/fiat/payments.
 */
class BinanceGetSapiV1FiatPayments extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_fiat_payments';
    protected const DESCRIPTION = 'Fiat Payments History (USER_DATA)

- If beginTime and endTime are not sent, the recent 30-day data will be returned. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/fiat/payments.';
    protected const PARAMETERS = [
        'transaction_type' => [
            'type' => 'integer',
            'required' => true,
            'description' => '* `0` - deposit * `1` - withdraw',
        ],
        'begin_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `beginTime`.',
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
        'rows' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 100, max 500',
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
    protected const PATH = '/sapi/v1/fiat/payments';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'transactionType' => 'transaction_type',
        'beginTime' => 'begin_time',
        'endTime' => 'end_time',
        'page' => 'page',
        'rows' => 'rows',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
