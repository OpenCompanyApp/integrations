<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Subscribe Locked Product (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/simple-earn/locked/subscribe.
 */
class BinancePostSapiV1SimpleEarnLockedSubscribe extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_simple_earn_locked_subscribe';
    protected const DESCRIPTION = 'Subscribe Locked Product (TRADE)

Weight(IP): 1 Rate Limit: 1/3s per account

Official Binance Spot endpoint: POST /sapi/v1/simple-earn/locked/subscribe.';
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
        'source_account' => [
            'type' => 'string',
            'required' => false,
            'description' => 'SPOT,FUND,ALL, default SPOT',
        ],
        'redeem_to' => [
            'type' => 'string',
            'required' => false,
            'description' => 'SPOT,FLEXIBLE, default FLEXIBLE',
            'enum' => [
                'SPOT',
                'FLEXIBLE',
            ],
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
    protected const PATH = '/sapi/v1/simple-earn/locked/subscribe';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'projectId' => 'project_id',
        'amount' => 'amount',
        'autoSubscribe' => 'auto_subscribe',
        'sourceAccount' => 'source_account',
        'redeemTo' => 'redeem_to',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
