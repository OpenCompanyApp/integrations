<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Flexible Rewards History (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/simple-earn/flexible/history/rewardsRecord.
 */
class BinanceGetSapiV1SimpleEarnFlexibleHistoryRewardsrecord extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_simple_earn_flexible_history_rewardsrecord';
    protected const DESCRIPTION = 'Get Flexible Rewards History (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/flexible/history/rewardsRecord.';
    protected const PARAMETERS = [
        'product_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `productId`.',
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
        'type' => [
            'type' => 'string',
            'required' => true,
            'description' => '"BONUS", "REALTIME", "REWARDS"',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/simple-earn/flexible/history/rewardsRecord';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'productId' => 'product_id',
        'asset' => 'asset',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'type' => 'type',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}
