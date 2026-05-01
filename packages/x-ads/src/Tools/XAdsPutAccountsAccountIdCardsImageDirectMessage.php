<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Creatives / Image Direct Message Cards accounts/:account_id/cards/image_direct_message.
 */
class XAdsPutAccountsAccountIdCardsImageDirectMessage extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_put_accounts_account_id_cards_image_direct_message';

    protected const DESCRIPTION = 'X Ads API operation: Creatives / Image Direct Message Cards accounts/:account_id/cards/image_direct_message.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'card_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'first_cta' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'first_cta_welcome_message_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'media_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'second_cta' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'second_cta_welcome_message_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'third_cta' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'third_cta_welcome_message_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'fourth_cta' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'fourth_cta_welcome_message_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'put_accounts_account_id_cards_image_direct_message',
        'method' => 'PUT',
        'path' => '/{version}/accounts/{account_id}/cards/image_direct_message',
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
                'name' => 'card_id',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'first_cta',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'first_cta_welcome_message_id',
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
                'name' => 'second_cta',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'second_cta_welcome_message_id',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'third_cta',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'third_cta_welcome_message_id',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'fourth_cta',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'fourth_cta_welcome_message_id',
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
            'Image Direct Message Cards',
        ],
    ];
}
