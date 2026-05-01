<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Audience Summary accounts/:account_id/audience_summary.
 */
class XAdsPostAccountsAccountIdAudienceSummary extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_audience_summary';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Audience Summary accounts/:account_id/audience_summary.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'targeting_criteria' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_audience_summary',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/audience_summary',
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
                'name' => 'targeting_criteria',
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
            'Campaign Management',
            'Audience Summary',
        ],
    ];
}
