<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Audience / Tailored Audiences Users accounts/:account_id/tailored_audiences/:tailored_audience_id/users.
 */
class XAdsPostAccountsAccountIdTailoredAudiencesTailoredAudienceIdUsers extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_tailored_audiences_tailored_audience_id_users';

    protected const DESCRIPTION = 'X Ads API operation: Audience / Tailored Audiences Users accounts/:account_id/tailored_audiences/:tailored_audience_id/users.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'operation_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'params' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'users' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'effective_at' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'expires_at' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_tailored_audiences_tailored_audience_id_users',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/tailored_audiences/:tailored_audience_id/users',
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
                'name' => 'operation_type',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'params',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'users',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'effective_at',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'expires_at',
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
            'Audience',
            'Tailored Audiences Users',
        ],
    ];
}
