<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Line Items accounts/:account_id/line_items.
 */
class XAdsPostAccountsAccountIdLineItems extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_line_items';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Line Items accounts/:account_id/line_items.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'campaign_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'objective' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'placements' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'product_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'advertiser_domain' => [
            'type' => 'string',
            'required' => true,
            'description' => 'sometimes required',
        ],
        'bid_amount_local_micro' => [
            'type' => 'string',
            'required' => true,
            'description' => 'sometimes required',
        ],
        'categories' => [
            'type' => 'string',
            'required' => true,
            'description' => 'sometimes required',
        ],
        'primary_web_event_tag' => [
            'type' => 'string',
            'required' => true,
            'description' => 'sometimes required',
        ],
        'advertiser_user_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'automatically_select_bid' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'bid_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'bid_unit' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'charge_by' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'end_time' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'entity_status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'include_sentiment' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'audience_expansion' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'optimization' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'start_time' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'total_budget_amount_local_micro' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'tracking_tags' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_line_items',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/line_items',
        'parameters' => [
            [
                'name' => 'version',
                'in' => 'path',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'account_id',
                'in' => 'path',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'campaign_id',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'objective',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'placements',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'product_type',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'advertiser_domain',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'bid_amount_local_micro',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'categories',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'primary_web_event_tag',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'advertiser_user_id',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'automatically_select_bid',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'bid_type',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'bid_unit',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'charge_by',
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
                'name' => 'entity_status',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'include_sentiment',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'audience_expansion',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'name',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'optimization',
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
            [
                'name' => 'total_budget_amount_local_micro',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'tracking_tags',
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
            'Line Items',
        ],
    ];
}
