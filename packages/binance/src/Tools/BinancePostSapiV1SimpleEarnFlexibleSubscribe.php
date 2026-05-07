<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Subscribe Flexible Product (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/simple-earn/flexible/subscribe.
 */
class BinancePostSapiV1SimpleEarnFlexibleSubscribe extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_simple_earn_flexible_subscribe';
    protected const DESCRIPTION = 'Subscribe Flexible Product (TRADE)

Weight(IP): 1 Rate Limit: 1/3s per account

Official Binance Spot endpoint: POST /sapi/v1/simple-earn/flexible/subscribe.';
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
        'auto_subscribe' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'true or false, default true.',
        ],
        'source_account' => [
            'type' => 'string',
            'required' => false,
            'description' => 'SPOT,FUND,ALL, default SPOT',
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
    protected const METHOD = 'POST';
    protected const PATH = '/sapi/v1/simple-earn/flexible/subscribe';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'productId' => 'product_id',
        'amount' => 'amount',
        'autoSubscribe' => 'auto_subscribe',
        'sourceAccount' => 'source_account',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
