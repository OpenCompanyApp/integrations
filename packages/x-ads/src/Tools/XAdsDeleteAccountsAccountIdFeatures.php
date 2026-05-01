<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Features accounts/:account_id/features.
 */
class XAdsDeleteAccountsAccountIdFeatures extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_delete_accounts_account_id_features';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Features accounts/:account_id/features.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'feature_keys' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
    ];

    protected const OPERATION = [
        'id' => 'delete_accounts_account_id_features',
        'method' => 'DELETE',
        'path' => '/{version}/accounts/{account_id}/features',
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
                'name' => 'feature_keys',
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
            'Features',
        ],
    ];
}
