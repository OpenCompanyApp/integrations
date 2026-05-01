<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Creatives / Draft Tweets accounts/:account_id/draft_tweets.
 */
class XAdsPostAccountsAccountIdDraftTweets extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_draft_tweets';

    protected const DESCRIPTION = 'X Ads API operation: Creatives / Draft Tweets accounts/:account_id/draft_tweets.';

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
            'required' => false,
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
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_draft_tweets',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/draft_tweets',
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
                'required' => false,
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
            'Draft Tweets',
        ],
    ];
}
