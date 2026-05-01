<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Creatives / Website Cards accounts/:account_id/cards/website/:card_id.
 */
class XAdsDeleteAccountsAccountIdCardsWebsiteCardId extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_delete_accounts_account_id_cards_website_card_id';

    protected const DESCRIPTION = 'X Ads API operation: Creatives / Website Cards accounts/:account_id/cards/website/:card_id.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'delete_accounts_account_id_cards_website_card_id',
        'method' => 'DELETE',
        'path' => '/{version}/accounts/{account_id}/cards/website/:card_id',
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
            'Website Cards',
        ],
    ];
}
