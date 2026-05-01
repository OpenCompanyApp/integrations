<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Measurement / App Lists accounts/:account_id/app_lists.
 */
class XAdsPostAccountsAccountIdAppLists extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_app_lists';

    protected const DESCRIPTION = 'X Ads API operation: Measurement / App Lists accounts/:account_id/app_lists.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'app_store_identifiers' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'name' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_app_lists',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/app_lists',
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
                'name' => 'app_store_identifiers',
                'in' => 'query',
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
            'Measurement',
            'App Lists',
        ],
    ];
}
