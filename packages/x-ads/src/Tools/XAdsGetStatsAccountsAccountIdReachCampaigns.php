<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Analytics / Reach and Average Frequency stats/accounts/:account_id/reach/campaigns.
 */
class XAdsGetStatsAccountsAccountIdReachCampaigns extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_stats_accounts_account_id_reach_campaigns';

    protected const DESCRIPTION = 'X Ads API operation: Analytics / Reach and Average Frequency stats/accounts/:account_id/reach/campaigns.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'campaign_ids' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'end_time' => [
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
        'id' => 'get_stats_accounts_account_id_reach_campaigns',
        'method' => 'GET',
        'path' => '/{version}/stats/accounts/{account_id}/reach/campaigns',
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
                'name' => 'campaign_ids',
                'in' => 'query',
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
            'Reach and Average Frequency',
        ],
    ];
}
