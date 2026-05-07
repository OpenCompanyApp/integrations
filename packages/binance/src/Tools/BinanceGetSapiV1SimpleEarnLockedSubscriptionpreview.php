<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Locked Subscription Preview (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/simple-earn/locked/subscriptionPreview.
 */
class BinanceGetSapiV1SimpleEarnLockedSubscriptionpreview extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_simple_earn_locked_subscriptionpreview';
    protected const DESCRIPTION = 'Get Locked Subscription Preview (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/locked/subscriptionPreview.';
    protected const PARAMETERS = [
        'project_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `projectId`.',
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
    protected const PATH = '/sapi/v1/simple-earn/locked/subscriptionPreview';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'projectId' => 'project_id',
        'amount' => 'amount',
        'autoSubscribe' => 'auto_subscribe',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
