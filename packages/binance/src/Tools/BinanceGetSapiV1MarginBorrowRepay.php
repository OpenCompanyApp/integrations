<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query borrow/repay records in Margin account(USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/borrow-repay.
 */
class BinanceGetSapiV1MarginBorrowRepay extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_borrow_repay';
    protected const DESCRIPTION = 'Query borrow/repay records in Margin account(USER_DATA)

Query borrow/repay records in Margin account - txId or startTime must be sent. txId takes precedence. Response in descending order - If an asset is sent, data within 30 days before endTime; If an asset is not sent, data within 7 days before endTime - If neither startTime nor endTime is sent, the recent 7-day data will be returned. - startTime set as endTime - 7 days by default, endTime set as current time by default Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/borrow-repay.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `asset`.',
        ],
        'isolated_symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Isolated symbol',
        ],
        'tx_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'tranId in POST /sapi/v1/margin/loan',
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
        'type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'BORROW or REPAY',
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
    protected const PATH = '/sapi/v1/margin/borrow-repay';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'isolatedSymbol' => 'isolated_symbol',
        'txId' => 'tx_id',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'current' => 'current',
        'size' => 'size',
        'type' => 'type',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
