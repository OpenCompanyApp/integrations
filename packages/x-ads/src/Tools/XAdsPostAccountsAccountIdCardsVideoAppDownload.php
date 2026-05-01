<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Creatives / Video App Download Cards accounts/:account_id/cards/video_app_download.
 */
class XAdsPostAccountsAccountIdCardsVideoAppDownload extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_cards_video_app_download';

    protected const DESCRIPTION = 'X Ads API operation: Creatives / Video App Download Cards accounts/:account_id/cards/video_app_download.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'country_code' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'name' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'media_key' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'ipad_app_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'sometimes required',
        ],
        'iphone_app_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'sometimes required',
        ],
        'googleplay_app_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'sometimes required',
        ],
        'app_cta' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'ipad_deep_link' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'iphone_deep_link' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'googleplay_deep_link' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'poster_media_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_cards_video_app_download',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/cards/video_app_download',
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
                'name' => 'country_code',
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
                'name' => 'media_key',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'ipad_app_id',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'iphone_app_id',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'googleplay_app_id',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'app_cta',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'ipad_deep_link',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'iphone_deep_link',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'googleplay_deep_link',
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
            'Video App Download Cards',
        ],
    ];
}
