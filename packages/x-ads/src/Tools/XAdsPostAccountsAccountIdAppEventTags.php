<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Measurement / App Event Tags accounts/:account_id/app_event_tags.
 */
class XAdsPostAccountsAccountIdAppEventTags extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_app_event_tags';

    protected const DESCRIPTION = 'X Ads API operation: Measurement / App Event Tags accounts/:account_id/app_event_tags.';

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
        'conversion_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'os_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'provider_app_event_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'provider_app_event_name' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'deep_link_scheme' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'post_engagement_attribution_window' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'post_view_attribution_window' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'retargeting_enabled' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_app_event_tags',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/app_event_tags',
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
                'name' => 'conversion_type',
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
            [
                'name' => 'provider_app_event_id',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'provider_app_event_name',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'deep_link_scheme',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'post_engagement_attribution_window',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'post_view_attribution_window',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'retargeting_enabled',
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
            'Measurement',
            'App Event Tags',
        ],
    ];
}
