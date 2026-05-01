<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Creatives / Preroll Call To Actions accounts/:account_id/preroll_call_to_actions/:preroll_call_to_action_id.
 */
class XAdsPutAccountsAccountIdPrerollCallToActionsPrerollCallToActionId extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_put_accounts_account_id_preroll_call_to_actions_preroll_call_to_action_id';

    protected const DESCRIPTION = 'X Ads API operation: Creatives / Preroll Call To Actions accounts/:account_id/preroll_call_to_actions/:preroll_call_to_action_id.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'call_to_action' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'call_to_action_url' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'put_accounts_account_id_preroll_call_to_actions_preroll_call_to_action_id',
        'method' => 'PUT',
        'path' => '/{version}/accounts/{account_id}/preroll_call_to_actions/:preroll_call_to_action_id',
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
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'call_to_action_url',
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
            'Creatives',
            'Preroll Call To Actions',
        ],
    ];
}
