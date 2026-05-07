<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * One Time Transaction(TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/lending/auto-invest/one-off.
 */
class BinancePostSapiV1LendingAutoInvestOneOff extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_lending_auto_invest_one_off';
    protected const DESCRIPTION = 'One Time Transaction(TRADE)

One time transaction Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/lending/auto-invest/one-off.';
    protected const PARAMETERS = [
        'source_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `sourceType`.',
        ],
        'request_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `requestId`.',
        ],
        'subscription_amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'query parameter `subscriptionAmount`.',
        ],
        'source_asset' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `sourceAsset`.',
        ],
        'flexible_allowed_to_use' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'query parameter `flexibleAllowedToUse`.',
        ],
        'plan_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `planId`.',
        ],
        'index_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `indexId`.',
        ],
        'details' => [
            'type' => 'array',
            'required' => false,
            'description' => 'query parameter `details`.',
            'items' => [
                'type' => 'object',
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
    protected const PATH = '/sapi/v1/lending/auto-invest/one-off';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'sourceType' => 'source_type',
        'requestId' => 'request_id',
        'subscriptionAmount' => 'subscription_amount',
        'sourceAsset' => 'source_asset',
        'flexibleAllowedToUse' => 'flexible_allowed_to_use',
        'planId' => 'plan_id',
        'indexId' => 'index_id',
        'details' => 'details',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
