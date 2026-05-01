<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Creatives / Draft Tweets accounts/:account_id/draft_tweets/preview/:draft_tweet_id.
 */
class XAdsPostAccountsAccountIdDraftTweetsPreviewDraftTweetId extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_draft_tweets_preview_draft_tweet_id';

    protected const DESCRIPTION = 'X Ads API operation: Creatives / Draft Tweets accounts/:account_id/draft_tweets/preview/:draft_tweet_id.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_draft_tweets_preview_draft_tweet_id',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/draft_tweets/preview/:draft_tweet_id',
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
            'Draft Tweets',
        ],
    ];
}
