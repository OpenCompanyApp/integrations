<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Investment plan adjustment.
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/lending/auto-invest/plan/edit.
 */
class BinancePostSapiV1LendingAutoInvestPlanEdit extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_lending_auto_invest_plan_edit';
    protected const DESCRIPTION = 'Investment plan adjustment

Query Source Asset to be used for investment Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/lending/auto-invest/plan/edit.';
    protected const PARAMETERS = [
        'plan_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'query parameter `planId`.',
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
    protected const PATH = '/sapi/v1/lending/auto-invest/plan/edit';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'planId' => 'plan_id',
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
