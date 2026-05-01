<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Creatives / Tweets accounts/:account_id/tweet.
 */
class XAdsPostAccountsAccountIdTweet extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_tweet';

    protected const DESCRIPTION = 'X Ads API operation: Creatives / Tweets accounts/:account_id/tweet.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'as_user_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'text' => [
            'type' => 'string',
            'required' => true,
            'description' => 'sometimes required',
        ],
        'card_uri' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'media_keys' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'nullcast' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'trim_user' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'tweet_mode' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'video_cta' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'video_cta_value' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'video_description' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'video_title' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_tweet',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/tweet',
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
                'name' => 'as_user_id',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'text',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'card_uri',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'media_keys',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'nullcast',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'trim_user',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'tweet_mode',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'video_cta',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'video_cta_value',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'video_description',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'video_title',
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
            'Tweets',
        ],
    ];
}
