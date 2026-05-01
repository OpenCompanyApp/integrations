<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Audience / Tailored Audience Permissions accounts/:account_id/tailored_audiences/:tailored_audience_id/permissions.
 */
class XAdsPostAccountsAccountIdTailoredAudiencesTailoredAudienceIdPermissions extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_tailored_audiences_tailored_audience_id_permissions';

    protected const DESCRIPTION = 'X Ads API operation: Audience / Tailored Audience Permissions accounts/:account_id/tailored_audiences/:tailored_audience_id/permissions.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'granted_account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'permission_level' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_tailored_audiences_tailored_audience_id_permissions',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/tailored_audiences/:tailored_audience_id/permissions',
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
                'name' => 'granted_account_id',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'permission_level',
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
            'Tailored Audience Permissions',
        ],
    ];
}
