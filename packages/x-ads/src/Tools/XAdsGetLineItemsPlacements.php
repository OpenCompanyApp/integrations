<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Line Item Placements line_items/placements.
 */
class XAdsGetLineItemsPlacements extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_line_items_placements';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Line Item Placements line_items/placements.';

    protected const PARAMETERS = [
        'product_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'get_line_items_placements',
        'method' => 'GET',
        'path' => '/{version}/line_items/placements',
        'parameters' => [
            [
                'name' => 'version',
                'in' => 'path',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'product_type',
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
            'Line Item Placements',
        ],
    ];
}
