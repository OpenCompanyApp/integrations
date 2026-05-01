<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Audience / Tailored Audiences accounts/:account_id/tailored_audiences/:tailored_audience_id.
 */
class XAdsDeleteAccountsAccountIdTailoredAudiencesTailoredAudienceId extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_delete_accounts_account_id_tailored_audiences_tailored_audience_id';

    protected const DESCRIPTION = 'X Ads API operation: Audience / Tailored Audiences accounts/:account_id/tailored_audiences/:tailored_audience_id.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body or form fields for this X Ads API operation.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'delete_accounts_account_id_tailored_audiences_tailored_audience_id',
        'method' => 'DELETE',
        'path' => '/{version}/accounts/{account_id}/tailored_audiences/:tailored_audience_id',
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
        'has_body' => true,
        'body_mode' => 'json',
        'auth_modes' => [
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'ads_api_access',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Audience',
            'Tailored Audiences',
        ],
    ];
}
