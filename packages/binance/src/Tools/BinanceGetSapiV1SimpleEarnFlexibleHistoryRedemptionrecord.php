<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Flexible Redemption Record (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/simple-earn/flexible/history/redemptionRecord.
 */
class BinanceGetSapiV1SimpleEarnFlexibleHistoryRedemptionrecord extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_simple_earn_flexible_history_redemptionrecord';
    protected const DESCRIPTION = 'Get Flexible Redemption Record (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/flexible/history/redemptionRecord.';
    protected const PARAMETERS = [
        'product_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `productId`.',
        ],
        'redeem_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `redeemId`.',
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/simple-earn/flexible/history/redemptionRecord';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'productId' => 'product_id',
        'redeemId' => 'redeem_id',
        'asset' => 'asset',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'current' => 'current',
        'size' => 'size',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}
