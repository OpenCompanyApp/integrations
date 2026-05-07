<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Flexible Subscription Preview (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/simple-earn/flexible/subscriptionPreview.
 */
class BinanceGetSapiV1SimpleEarnFlexibleSubscriptionpreview extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_simple_earn_flexible_subscriptionpreview';
    protected const DESCRIPTION = 'Get Flexible Subscription Preview (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/flexible/subscriptionPreview.';
    protected const PARAMETERS = [
        'product_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `productId`.',
        ],
        'amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'query parameter `amount`.',
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
    protected const PATH = '/sapi/v1/simple-earn/flexible/subscriptionPreview';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'productId' => 'product_id',
        'amount' => 'amount',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
