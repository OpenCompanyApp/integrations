<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Measurement / Web Event Tags accounts/:account_id/web_event_tags.
 */
class XAdsPostAccountsAccountIdWebEventTags extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_web_event_tags';

    protected const DESCRIPTION = 'X Ads API operation: Measurement / Web Event Tags accounts/:account_id/web_event_tags.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'click_window' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'name' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'retargeting_enabled' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'view_through_window' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_web_event_tags',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/web_event_tags',
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
                'name' => 'click_window',
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
            [
                'name' => 'retargeting_enabled',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'type',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'view_through_window',
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
            'Web Event Tags',
        ],
    ];
}
