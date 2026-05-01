<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / User Settings accounts/:account_id/user_settings/:user_id.
 */
class XAdsPutAccountsAccountIdUserSettingsUserId extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_put_accounts_account_id_user_settings_user_id';

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
        'notification_email' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'contact_phone' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'contact_phone_extension' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'subscribed_email_types' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'put_accounts_account_id_user_settings_user_id',
        'method' => 'PUT',
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
            [
                'name' => 'notification_email',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'contact_phone',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'contact_phone_extension',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'subscribed_email_types',
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
            'User Settings',
        ],
    ];
}
