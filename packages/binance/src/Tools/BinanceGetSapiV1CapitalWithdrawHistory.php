<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Withdraw History (supporting network) (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/capital/withdraw/history.
 */
class BinanceGetSapiV1CapitalWithdrawHistory extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_capital_withdraw_history';
    protected const DESCRIPTION = 'Withdraw History (supporting network) (USER_DATA)

Fetch withdraw history. This endpoint specifically uses per second UID rate limit, user\'s total second level IP rate limit is 180000/second. Response from the endpoint contains header key X-SAPI-USED-UID-WEIGHT-1S, which defines weight used by the current IP. - `network` may not be in the response for old withdraw. - Please notice the default `startTime` and `endTime` to make sure that time interval is within 0-90 days. - If both `startTime` and `endTime` are sent, time between `startTime` and `endTime` must be less than 90 days - If withdrawOrderId is sent, time between startTime and endTime must be less than 7 days. - If withdrawOrderId is sent, startTime and endTime are not sent, will return last 7 days records by default. Weight(UID): 18000 Request Limit: 10 requests per second

Official Binance Spot endpoint: GET /sapi/v1/capital/withdraw/history.';
    protected const PARAMETERS = [
        'coin' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Coin name',
        ],
        'withdraw_order_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `withdrawOrderId`.',
        ],
        'status' => [
            'type' => 'integer',
            'required' => false,
            'description' => '* `0` - Email Sent * `1` - Cancelled * `2` - Awaiting Approval * `3` - Rejected * `4` - Processing * `5` - Failure * `6` - Completed',
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
        'offset' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `offset`.',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 500; max 1000.',
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
    protected const PATH = '/sapi/v1/capital/withdraw/history';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'coin' => 'coin',
        'withdrawOrderId' => 'withdraw_order_id',
        'status' => 'status',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'offset' => 'offset',
        'limit' => 'limit',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
