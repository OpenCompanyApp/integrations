<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Analytics / Auction Insights accounts/:account_id/auction_insights.
 */
class XAdsGetAccountsAccountIdAuctionInsights extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_accounts_account_id_auction_insights';

    protected const DESCRIPTION = 'X Ads API operation: Analytics / Auction Insights accounts/:account_id/auction_insights.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'end_time' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'granularity' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'line_item_ids' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'placement' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'start_time' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
    ];

    protected const OPERATION = [
        'id' => 'get_accounts_account_id_auction_insights',
        'method' => 'GET',
        'path' => '/{version}/accounts/{account_id}/auction_insights',
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
                'name' => 'end_time',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'granularity',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'line_item_ids',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'placement',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'start_time',
                'in' => 'query',
                'required' => true,
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
            'Analytics',
            'Auction Insights',
        ],
    ];
}
