<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Audience / Tailored Audiences accounts/:account_id/tailored_audiences.
 */
class XAdsPostAccountsAccountIdTailoredAudiences extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_tailored_audiences';

    protected const DESCRIPTION = 'X Ads API operation: Audience / Tailored Audiences accounts/:account_id/tailored_audiences.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'name' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_tailored_audiences',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/tailored_audiences',
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
                'name' => 'name',
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
            'Tailored Audiences',
        ],
    ];
}
