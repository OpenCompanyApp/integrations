<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Targeting Options targeting_criteria/platform_versions.
 */
class XAdsGetTargetingCriteriaPlatformVersions extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_targeting_criteria_platform_versions';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Targeting Options targeting_criteria/platform_versions.';

    protected const PARAMETERS = [
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
        'id' => 'get_targeting_criteria_platform_versions',
        'method' => 'GET',
        'path' => '/{version}/targeting_criteria/platform_versions',
        'parameters' => [
            [
                'name' => 'version',
                'in' => 'path',
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
