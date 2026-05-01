<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Targeting Options targeting_criteria/events.
 */
class XAdsGetTargetingCriteriaEvents extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_targeting_criteria_events';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Targeting Options targeting_criteria/events.';

    protected const PARAMETERS = [
        'event_types' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'count' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'country_codes' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'cursor' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'end_time' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'start_time' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'get_targeting_criteria_events',
        'method' => 'GET',
        'path' => '/{version}/targeting_criteria/events',
        'parameters' => [
            [
                'name' => 'version',
                'in' => 'path',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'event_types',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'count',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'country_codes',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'cursor',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'end_time',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'start_time',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
        ],
        'has_body' => false,
        'body_mode' => 'form',
        'auth_modes' => [
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'ads_api_access',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Campaign Management',
            'Targeting Options',
        ],
    ];
}
