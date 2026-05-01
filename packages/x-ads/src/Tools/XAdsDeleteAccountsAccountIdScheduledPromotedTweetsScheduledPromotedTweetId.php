<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Scheduled Promoted Tweets accounts/:account_id/scheduled_promoted_tweets/:scheduled_promoted_tweet_id.
 */
class XAdsDeleteAccountsAccountIdScheduledPromotedTweetsScheduledPromotedTweetId extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_delete_accounts_account_id_scheduled_promoted_tweets_scheduled_promoted_tweet_id';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Scheduled Promoted Tweets accounts/:account_id/scheduled_promoted_tweets/:scheduled_promoted_tweet_id.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'scheduled_promoted_tweet_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
    ];

    protected const OPERATION = [
        'id' => 'delete_accounts_account_id_scheduled_promoted_tweets_scheduled_promoted_tweet_id',
        'method' => 'DELETE',
        'path' => '/{version}/accounts/{account_id}/scheduled_promoted_tweets/:scheduled_promoted_tweet_id',
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
                'name' => 'scheduled_promoted_tweet_id',
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
            'Scheduled Promoted Tweets',
        ],
    ];
}
