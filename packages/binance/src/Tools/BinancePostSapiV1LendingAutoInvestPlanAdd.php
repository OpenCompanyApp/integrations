<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Investment plan creation (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/lending/auto-invest/plan/add.
 */
class BinancePostSapiV1LendingAutoInvestPlanAdd extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_lending_auto_invest_plan_add';
    protected const DESCRIPTION = 'Investment plan creation (USER_DATA)

Post an investment plan creation Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/lending/auto-invest/plan/add.';
    protected const PARAMETERS = [
        'source_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `sourceType`.',
            'enum' => [
                'MAIN_SITE',
                'TR',
            ],
        ],
        'request_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `requestId`.',
        ],
        'plan_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `planType`.',
            'enum' => [
                'SINGLE',
                'PORTFOLIO',
                'INDEX',
            ],
        ],
        'index_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `IndexId`.',
        ],
        'subscription_amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'query parameter `subscriptionAmount`.',
        ],
        'subscription_cycle' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `subscriptionCycle`.',
            'enum' => [
                'H1',
                'H4',
                'H8',
                'H12',
                'WEEKLY',
                'DAILY',
                'MONTHLY',
                'BI_WEEKLY',
            ],
        ],
        'subscription_start_day' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `subscriptionStartDay`.',
        ],
        'subscription_start_weekday' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `subscriptionStartWeekday`.',
            'enum' => [
                'MON',
                'TUE',
                'WED',
                'THU',
                'FRI',
                'SAT',
                'SUN',
            ],
        ],
        'subscription_start_time' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'query parameter `subscriptionStartTime`.',
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
        'details' => [
            'type' => 'array',
            'required' => true,
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
    protected const PATH = '/sapi/v1/lending/auto-invest/plan/add';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'sourceType' => 'source_type',
        'requestId' => 'request_id',
        'planType' => 'plan_type',
        'IndexId' => 'index_id',
        'subscriptionAmount' => 'subscription_amount',
        'subscriptionCycle' => 'subscription_cycle',
        'subscriptionStartDay' => 'subscription_start_day',
        'subscriptionStartWeekday' => 'subscription_start_weekday',
        'subscriptionStartTime' => 'subscription_start_time',
        'sourceAsset' => 'source_asset',
        'flexibleAllowedToUse' => 'flexible_allowed_to_use',
        'details' => 'details',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
