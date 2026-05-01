<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Targeting Options targeting_criteria/devices.
 */
class XAdsGetTargetingCriteriaDevices extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_targeting_criteria_devices';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Targeting Options targeting_criteria/devices.';

    protected const PARAMETERS = [
        'count' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'q' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'os_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'get_targeting_criteria_devices',
        'method' => 'GET',
        'path' => '/{version}/targeting_criteria/devices',
        'parameters' => [
            [
                'name' => 'version',
                'in' => 'path',
                'required' => false,
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
                'name' => 'q',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'os_type',
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
