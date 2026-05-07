<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Locked Subscription Record (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/simple-earn/locked/history/subscriptionRecord.
 */
class BinanceGetSapiV1SimpleEarnLockedHistorySubscriptionrecord extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_simple_earn_locked_history_subscriptionrecord';
    protected const DESCRIPTION = 'Get Locked Subscription Record (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/locked/history/subscriptionRecord.';
    protected const PARAMETERS = [
        'purchase_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `purchaseId`.',
        ],
        'asset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `asset`.',
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
    protected const PATH = '/sapi/v1/simple-earn/locked/history/subscriptionRecord';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'purchaseId' => 'purchase_id',
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
