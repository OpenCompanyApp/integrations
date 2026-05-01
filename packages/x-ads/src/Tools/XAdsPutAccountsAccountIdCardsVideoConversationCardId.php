<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Creatives / Video Conversation Cards accounts/:account_id/cards/video_conversation/:card_id.
 */
class XAdsPutAccountsAccountIdCardsVideoConversationCardId extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_put_accounts_account_id_cards_video_conversation_card_id';

    protected const DESCRIPTION = 'X Ads API operation: Creatives / Video Conversation Cards accounts/:account_id/cards/video_conversation/:card_id.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'unlocked_image_media_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'unlocked_video_media_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'poster_media_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'first_cta' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'first_cta_tweet' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'second_cta' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'second_cta_tweet' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'third_cta' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'third_cta_tweet' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'fourth_cta' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'fourth_cta_tweet' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'thank_you_text' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'thank_you_url' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'title' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'media_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'put_accounts_account_id_cards_video_conversation_card_id',
        'method' => 'PUT',
        'path' => '/{version}/accounts/{account_id}/cards/video_conversation/:card_id',
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
                'name' => 'unlocked_image_media_key',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'unlocked_video_media_key',
                'in' => 'query',
                'required' => false,
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
                'name' => 'first_cta',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'first_cta_tweet',
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
                'name' => 'second_cta_tweet',
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
                'name' => 'third_cta_tweet',
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
                'name' => 'fourth_cta_tweet',
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
                'name' => 'thank_you_text',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'thank_you_url',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'title',
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
            'Video Conversation Cards',
        ],
    ];
}
