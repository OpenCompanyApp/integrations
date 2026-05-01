<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Creatives / Cards Fetch accounts/:account_id/cards/all.
 */
class XAdsGetAccountsAccountIdCardsAll extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_accounts_account_id_cards_all';

    protected const DESCRIPTION = 'X Ads API operation: Creatives / Cards Fetch accounts/:account_id/cards/all.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'card_uris' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'with_deleted' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'get_accounts_account_id_cards_all',
        'method' => 'GET',
        'path' => '/{version}/accounts/{account_id}/cards/all',
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
                'name' => 'card_uris',
                'in' => 'query',
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
            'Cards Fetch',
        ],
    ];
}
