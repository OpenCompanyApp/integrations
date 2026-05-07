<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Future Account Transaction History List (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/futures/transfer.
 */
class BinanceGetSapiV1FuturesTransfer extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_futures_transfer';
    protected const DESCRIPTION = 'Get Future Account Transaction History List (USER_DATA)

Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/futures/transfer.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `asset`.',
        ],
        'start_time' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'UTC timestamp in ms',
        ],
        'end_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'current' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Current querying page. Start from 1. Default:1',
        ],
        'size' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default:10 Max:100',
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
    protected const PATH = '/sapi/v1/futures/transfer';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'current' => 'current',
        'size' => 'size',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
