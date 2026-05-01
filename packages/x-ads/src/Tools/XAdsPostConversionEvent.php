<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Measurement / Conversion Event conversion_event.
 */
class XAdsPostConversionEvent extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_conversion_event';

    protected const DESCRIPTION = 'X Ads API operation: Measurement / Conversion Event conversion_event.';

    protected const PARAMETERS = [
        'app_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'conversion_time' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'conversion_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'hashed_device_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'os_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'click_window' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'extra_device_ids' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'non_twitter_engagement_time' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'non_twitter_engagement_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'view_through_window' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_conversion_event',
        'method' => 'POST',
        'path' => '/{version}/conversion_event',
        'parameters' => [
            [
                'name' => 'version',
                'in' => 'path',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'app_id',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'conversion_time',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'conversion_type',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'hashed_device_id',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'os_type',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'click_window',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'extra_device_ids',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'non_twitter_engagement_time',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'non_twitter_engagement_type',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'view_through_window',
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
            'Measurement',
            'Conversion Event',
        ],
    ];
}
