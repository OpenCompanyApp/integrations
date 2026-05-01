<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Creatives / Account Media accounts/:account_id/account_media/:account_media_id.
 */
class XAdsDeleteAccountsAccountIdAccountMediaAccountMediaId extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_delete_accounts_account_id_account_media_account_media_id';

    protected const DESCRIPTION = 'X Ads API operation: Creatives / Account Media accounts/:account_id/account_media/:account_media_id.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'delete_accounts_account_id_account_media_account_media_id',
        'method' => 'DELETE',
        'path' => '/{version}/accounts/{account_id}/account_media/:account_media_id',
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
            'Account Media',
        ],
    ];
}
