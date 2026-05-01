<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Content Categories content_categories.
 */
class XAdsGetContentCategories extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_content_categories';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Content Categories content_categories.';

    protected const PARAMETERS = [
    ];

    protected const OPERATION = [
        'id' => 'get_content_categories',
        'method' => 'GET',
        'path' => '/{version}/content_categories',
        'parameters' => [
            [
                'name' => 'version',
                'in' => 'path',
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
            'Content Categories',
        ],
    ];
}
