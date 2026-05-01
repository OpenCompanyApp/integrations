<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Measurement / Web Event Tags accounts/:account_id/web_event_tags/:web_event_tag_id.
 */
class XAdsPutAccountsAccountIdWebEventTagsWebEventTagId extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_put_accounts_account_id_web_event_tags_web_event_tag_id';

    protected const DESCRIPTION = 'X Ads API operation: Measurement / Web Event Tags accounts/:account_id/web_event_tags/:web_event_tag_id.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'click_window' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'retargeting_enabled' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'view_through_window' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'put_accounts_account_id_web_event_tags_web_event_tag_id',
        'method' => 'PUT',
        'path' => '/{version}/accounts/{account_id}/web_event_tags/:web_event_tag_id',
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
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'name',
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
            [
                'name' => 'type',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'view_through_window',
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
            'Web Event Tags',
        ],
    ];
}
