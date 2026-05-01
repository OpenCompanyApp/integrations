<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Bidding Rules bidding_rules.
 */
class XAdsGetBiddingRules extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_bidding_rules';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Bidding Rules bidding_rules.';

    protected const PARAMETERS = [
        'currency' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'get_bidding_rules',
        'method' => 'GET',
        'path' => '/{version}/bidding_rules',
        'parameters' => [
            [
                'name' => 'version',
                'in' => 'path',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'currency',
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
            'Bidding Rules',
        ],
    ];
}
