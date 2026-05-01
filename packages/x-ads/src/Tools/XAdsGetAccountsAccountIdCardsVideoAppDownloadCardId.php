<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Creatives / Video App Download Cards accounts/:account_id/cards/video_app_download/:card_id.
 */
class XAdsGetAccountsAccountIdCardsVideoAppDownloadCardId extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_accounts_account_id_cards_video_app_download_card_id';

    protected const DESCRIPTION = 'X Ads API operation: Creatives / Video App Download Cards accounts/:account_id/cards/video_app_download/:card_id.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'with_deleted' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'get_accounts_account_id_cards_video_app_download_card_id',
        'method' => 'GET',
        'path' => '/{version}/accounts/{account_id}/cards/video_app_download/:card_id',
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
                'name' => 'with_deleted',
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
