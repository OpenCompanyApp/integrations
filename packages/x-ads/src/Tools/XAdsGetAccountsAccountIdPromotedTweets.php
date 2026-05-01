<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Promoted Tweets accounts/:account_id/promoted_tweets.
 */
class XAdsGetAccountsAccountIdPromotedTweets extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_accounts_account_id_promoted_tweets';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Promoted Tweets accounts/:account_id/promoted_tweets.';

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
        'line_item_ids' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'promoted_tweet_ids' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'sort_by' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'with_deleted' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'with_total_count' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'get_accounts_account_id_promoted_tweets',
        'method' => 'GET',
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
                'name' => 'line_item_ids',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'promoted_tweet_ids',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'sort_by',
                'in' => 'query',
                'required' => false,
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
            [
                'name' => 'with_total_count',
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
            'Campaign Management',
            'Promoted Tweets',
        ],
    ];
}
