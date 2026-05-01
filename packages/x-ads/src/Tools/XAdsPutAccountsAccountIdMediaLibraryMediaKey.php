<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Creatives / Media Library accounts/:account_id/media_library/:media_key.
 */
class XAdsPutAccountsAccountIdMediaLibraryMediaKey extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_put_accounts_account_id_media_library_media_key';

    protected const DESCRIPTION = 'X Ads API operation: Creatives / Media Library accounts/:account_id/media_library/:media_key.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'description' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'file_name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'poster_media_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'title' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'put_accounts_account_id_media_library_media_key',
        'method' => 'PUT',
        'path' => '/{version}/accounts/{account_id}/media_library/:media_key',
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
                'name' => 'description',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'file_name',
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
                'name' => 'poster_media_key',
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
