<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Measurement / App Event Tags accounts/:account_id/app_event_tags/:id.
 */
class XAdsDeleteAccountsAccountIdAppEventTagsId extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_delete_accounts_account_id_app_event_tags_id';

    protected const DESCRIPTION = 'X Ads API operation: Measurement / App Event Tags accounts/:account_id/app_event_tags/:id.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'delete_accounts_account_id_app_event_tags_id',
        'method' => 'DELETE',
        'path' => '/{version}/accounts/{account_id}/app_event_tags/:id',
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
            'App Event Tags',
        ],
    ];
}
