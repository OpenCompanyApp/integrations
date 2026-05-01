<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Audience / Tailored Audiences accounts/:account_id/tailored_audiences.
 */
class XAdsGetAccountsAccountIdTailoredAudiences extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_accounts_account_id_tailored_audiences';

    protected const DESCRIPTION = 'X Ads API operation: Audience / Tailored Audiences accounts/:account_id/tailored_audiences.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'count' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'cursor' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'permission_scope' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'q' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'sort_by' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'tailored_audience_ids' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'with_deleted' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'with_total_count' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'get_accounts_account_id_tailored_audiences',
        'method' => 'GET',
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
                'name' => 'count',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'cursor',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'permission_scope',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'q',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'sort_by',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'tailored_audience_ids',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'with_deleted',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'with_total_count',
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
            'Tailored Audiences',
        ],
    ];
}
