<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Audience / Insights insights/accounts/:account_id/available_audiences.
 */
class XAdsGetInsightsAccountsAccountIdAvailableAudiences extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_insights_accounts_account_id_available_audiences';

    protected const DESCRIPTION = 'X Ads API operation: Audience / Insights insights/accounts/:account_id/available_audiences.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'get_insights_accounts_account_id_available_audiences',
        'method' => 'GET',
        'path' => '/{version}/insights/accounts/{account_id}/available_audiences',
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
