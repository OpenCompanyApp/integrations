<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Creatives / Media Library accounts/:account_id/media_library.
 */
class XAdsGetAccountsAccountIdMediaLibrary extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_accounts_account_id_media_library';

    protected const DESCRIPTION = 'X Ads API operation: Creatives / Media Library accounts/:account_id/media_library.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'count' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'cursor' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'media_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'q' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'get_accounts_account_id_media_library',
        'method' => 'GET',
        'path' => '/{version}/accounts/{account_id}/media_library',
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
                'name' => 'count',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'cursor',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'media_type',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'q',
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
            'Media Library',
        ],
    ];
}
