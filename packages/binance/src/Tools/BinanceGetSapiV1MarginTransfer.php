<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Cross Margin Transfer History (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/transfer.
 */
class BinanceGetSapiV1MarginTransfer extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_transfer';
    protected const DESCRIPTION = 'Get Cross Margin Transfer History (USER_DATA)

- Response in descending order - Returns data for last 7 days by default - Set `archived` to `true` to query data from 6 months ago Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/margin/transfer.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `asset`.',
        ],
        'type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `type`.',
            'enum' => [
                'ROLL_IN',
                'ROLL_OUT',
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
        'isolated_symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Isolated symbol',
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
    protected const PATH = '/sapi/v1/margin/transfer';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'type' => 'type',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'current' => 'current',
        'size' => 'size',
        'isolatedSymbol' => 'isolated_symbol',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
