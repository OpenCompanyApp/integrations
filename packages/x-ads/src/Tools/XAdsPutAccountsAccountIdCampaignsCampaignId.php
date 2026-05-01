<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Campaigns accounts/:account_id/campaigns/:campaign_id.
 */
class XAdsPutAccountsAccountIdCampaignsCampaignId extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_put_accounts_account_id_campaigns_campaign_id';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Campaigns accounts/:account_id/campaigns/:campaign_id.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'daily_budget_amount_local_micro' => [
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
        'duration_in_days' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'frequency_cap' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'standard_delivery' => [
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
    ];

    protected const OPERATION = [
        'id' => 'put_accounts_account_id_campaigns_campaign_id',
        'method' => 'PUT',
        'path' => '/{version}/accounts/{account_id}/campaigns/:campaign_id',
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
                'name' => 'daily_budget_amount_local_micro',
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
                'name' => 'duration_in_days',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'frequency_cap',
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
                'name' => 'standard_delivery',
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
            'Campaigns',
        ],
    ];
}
