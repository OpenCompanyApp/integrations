<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Creatives / Video Website Cards accounts/:account_id/cards/video_website.
 */
class XAdsPostAccountsAccountIdCardsVideoWebsite extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_cards_video_website';

    protected const DESCRIPTION = 'X Ads API operation: Creatives / Video Website Cards accounts/:account_id/cards/video_website.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'name' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'title' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'media_key' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'website_url' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_cards_video_website',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/cards/video_website',
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
                'name' => 'name',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'title',
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
                'name' => 'website_url',
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
            'Video Website Cards',
        ],
    ];
}
