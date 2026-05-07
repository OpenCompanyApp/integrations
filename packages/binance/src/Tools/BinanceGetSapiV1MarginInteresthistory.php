<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Interest History (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/interestHistory.
 */
class BinanceGetSapiV1MarginInteresthistory extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_interesthistory';
    protected const DESCRIPTION = 'Get Interest History (USER_DATA)

- Response in descending order - If `isolatedSymbol` is not sent, crossed margin data will be returned - Set `archived` to `true` to query data from 6 months ago - `type` in response has 4 enums: - `PERIODIC` interest charged per hour - `ON_BORROW` first interest charged on borrow - `PERIODIC_CONVERTED` interest charged per hour converted into BNB - `ON_BORROW_CONVERTED` first interest charged on borrow converted into BNB Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/margin/interestHistory.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `asset`.',
        ],
        'isolated_symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Isolated symbol',
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
        'archived' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default: false. Set to true for archived data from 6 months ago',
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
    protected const PATH = '/sapi/v1/margin/interestHistory';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'isolatedSymbol' => 'isolated_symbol',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'current' => 'current',
        'size' => 'size',
        'archived' => 'archived',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
