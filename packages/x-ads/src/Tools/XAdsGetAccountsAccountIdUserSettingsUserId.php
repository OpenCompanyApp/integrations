<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / User Settings accounts/:account_id/user_settings/:user_id.
 */
class XAdsGetAccountsAccountIdUserSettingsUserId extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_accounts_account_id_user_settings_user_id';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / User Settings accounts/:account_id/user_settings/:user_id.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'user_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
    ];

    protected const OPERATION = [
        'id' => 'get_accounts_account_id_user_settings_user_id',
        'method' => 'GET',
        'path' => '/{version}/accounts/{account_id}/user_settings/:user_id',
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
                'name' => 'user_id',
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
            'User Settings',
        ],
    ];
}
