<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Creatives / Tweet Previews accounts/:account_id/tweet_previews.
 */
class XAdsGetAccountsAccountIdTweetPreviews extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_accounts_account_id_tweet_previews';

    protected const DESCRIPTION = 'X Ads API operation: Creatives / Tweet Previews accounts/:account_id/tweet_previews.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'tweet_ids' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'tweet_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
    ];

    protected const OPERATION = [
        'id' => 'get_accounts_account_id_tweet_previews',
        'method' => 'GET',
        'path' => '/{version}/accounts/{account_id}/tweet_previews',
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
                'name' => 'tweet_ids',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'tweet_type',
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
            'Tweet Previews',
        ],
    ];
}
