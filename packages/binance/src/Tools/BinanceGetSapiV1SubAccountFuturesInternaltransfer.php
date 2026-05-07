<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Sub-account Futures Asset Transfer History (For Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/sub-account/futures/internalTransfer.
 */
class BinanceGetSapiV1SubAccountFuturesInternaltransfer extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_sub_account_futures_internaltransfer';
    protected const DESCRIPTION = 'Sub-account Futures Asset Transfer History (For Master Account)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/sub-account/futures/internalTransfer.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Sub-account email',
        ],
        'futures_type' => [
            'type' => 'integer',
            'required' => true,
            'description' => '1:USDT-margined Futures, 2: Coin-margined Futures',
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
            'description' => 'Default value: 50, Max value: 500',
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
    protected const PATH = '/sapi/v1/sub-account/futures/internalTransfer';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'futuresType' => 'futures_type',
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
