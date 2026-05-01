<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Creatives / Poll Cards accounts/:account_id/cards/poll.
 */
class XAdsPostAccountsAccountIdCardsPoll extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_cards_poll';

    protected const DESCRIPTION = 'X Ads API operation: Creatives / Poll Cards accounts/:account_id/cards/poll.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'duration_in_minutes' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'first_choice' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'name' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'second_choice' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'fourth_choice' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'media_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'third_choice' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_cards_poll',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/cards/poll',
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
                'name' => 'duration_in_minutes',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'first_choice',
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
                'name' => 'second_choice',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'fourth_choice',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'media_key',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'third_choice',
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
            'Poll Cards',
        ],
    ];
}
