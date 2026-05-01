<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Creatives / Video Direct Message Cards accounts/:account_id/cards/video_direct_message.
 */
class XAdsPostAccountsAccountIdCardsVideoDirectMessage extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_cards_video_direct_message';

    protected const DESCRIPTION = 'X Ads API operation: Creatives / Video Direct Message Cards accounts/:account_id/cards/video_direct_message.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'first_cta' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'first_cta_welcome_message_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'name' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'recipient_user_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'media_key' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'poster_media_key' => [
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
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_cards_video_direct_message',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/cards/video_direct_message',
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
                'name' => 'first_cta',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'first_cta_welcome_message_id',
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
                'name' => 'recipient_user_id',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'media_key',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'poster_media_key',
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
            'Video Direct Message Cards',
        ],
    ];
}
