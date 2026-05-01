<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Creatives / Preroll Call To Actions accounts/:account_id/preroll_call_to_actions.
 */
class XAdsPostAccountsAccountIdPrerollCallToActions extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_preroll_call_to_actions';

    protected const DESCRIPTION = 'X Ads API operation: Creatives / Preroll Call To Actions accounts/:account_id/preroll_call_to_actions.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'call_to_action' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'call_to_action_url' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'line_item_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_preroll_call_to_actions',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/preroll_call_to_actions',
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
                'name' => 'call_to_action',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'call_to_action_url',
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
            'Creatives',
            'Preroll Call To Actions',
        ],
    ];
}
