<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Line Item Apps accounts/:account_id/line_item_apps.
 */
class XAdsPostAccountsAccountIdLineItemApps extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_line_item_apps';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Line Item Apps accounts/:account_id/line_item_apps.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'app_store_identifier' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'line_item_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'os_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_line_item_apps',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/line_item_apps',
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
                'name' => 'app_store_identifier',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'line_item_id',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'os_type',
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
            'Line Item Apps',
        ],
    ];
}
