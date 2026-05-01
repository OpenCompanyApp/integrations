<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Creatives / Video Website Cards accounts/:account_id/cards/video_website/:card_id.
 */
class XAdsPutAccountsAccountIdCardsVideoWebsiteCardId extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_put_accounts_account_id_cards_video_website_card_id';

    protected const DESCRIPTION = 'X Ads API operation: Creatives / Video Website Cards accounts/:account_id/cards/video_website/:card_id.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'name' => [
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
        'website_url' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'put_accounts_account_id_cards_video_website_card_id',
        'method' => 'PUT',
        'path' => '/{version}/accounts/{account_id}/cards/video_website/:card_id',
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
            [
                'name' => 'website_url',
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
            'Video Website Cards',
        ],
    ];
}
