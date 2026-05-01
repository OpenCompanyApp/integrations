<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Audience / Insights insights/accounts/:account_id.
 */
class XAdsGetInsightsAccountsAccountId extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_insights_accounts_account_id';

    protected const DESCRIPTION = 'X Ads API operation: Audience / Insights insights/accounts/:account_id.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'audience_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'audience_value' => [
            'type' => 'string',
            'required' => true,
            'description' => 'sometimes required',
        ],
        'interaction_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'sometimes required',
        ],
    ];

    protected const OPERATION = [
        'id' => 'get_insights_accounts_account_id',
        'method' => 'GET',
        'path' => '/{version}/insights/accounts/{account_id}',
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
                'name' => 'audience_type',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'audience_value',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'interaction_type',
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
            'Audience',
            'Insights',
        ],
    ];
}
