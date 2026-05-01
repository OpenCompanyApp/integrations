<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Promoted Tweets accounts/:account_id/promoted_tweets.
 */
class XAdsPostAccountsAccountIdPromotedTweets extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_promoted_tweets';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Promoted Tweets accounts/:account_id/promoted_tweets.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'line_item_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'tweet_ids' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_promoted_tweets',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/promoted_tweets',
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
                'name' => 'line_item_id',
                'in' => 'query',
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
            'Campaign Management',
            'Promoted Tweets',
        ],
    ];
}
