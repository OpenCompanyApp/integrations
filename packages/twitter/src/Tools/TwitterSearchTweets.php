<?php

namespace OpenCompany\Integrations\Twitter\Tools;

use OpenCompany\Integrations\Twitter\TwitterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to search recent tweets (last 7 days) using a query.
 *
 * Calls `GET /tweets/search/recent` on the Twitter API v2.
 */
class TwitterSearchTweets implements Tool
{
    public function __construct(
        private TwitterService $service,
    ) {}

    public function name(): string
    {
        return 'twitter_search_tweets';
    }

    public function description(): string
    {
        return 'Search recent tweets from the last 7 days using a query string. Supports Twitter search operators (e.g., from:user, #hashtag, "exact phrase").';
    }

    public function parameters(): array
    {
        return [
            'query' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The search query. Supports operators: from:user, to:user, @mention, #hashtag, "exact phrase", lang:en, has:links, is:retweet, etc.',
            ],
            'max_results' => [
                'type' => 'integer',
                'description' => 'Number of tweets to return (10–100, default 10).',
            ],
            'tweet_fields' => [
                'type' => 'array',
                'description' => 'Additional tweet fields to include: attachments, author_id, context_annotations, conversation_id, created_at, edit_controls, entities, geo, id, in_reply_to_user_id, lang, non_public_metrics, note_tweet, organic_metrics, possibly_sensitive, promoted_metrics, public_metrics, referenced_tweets, reply_settings, source, text, withheld.',
            ],
            'next_token' => [
                'type' => 'string',
                'description' => 'Token for paginating through results. Pass the value from a previous response to get the next page.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitter integration is not configured.');
            }

            $maxResults = isset($args['max_results']) ? (int) $args['max_results'] : 10;
            $tweetFields = $args['tweet_fields'] ?? [];
            $nextToken = $args['next_token'] ?? null;

            $result = $this->service->searchTweets($args['query'], $maxResults, $tweetFields, $nextToken);

            $tweets = $result['data'] ?? [];
            $meta = $result['meta'] ?? [];

            $response = [
                'query' => $args['query'],
                'tweets' => $tweets,
                'count' => count($tweets),
            ];

            if (isset($meta['next_token'])) {
                $response['next_token'] = $meta['next_token'];
            }

            if (isset($meta['total_tweet_count'])) {
                $response['total_tweet_count'] = $meta['total_tweet_count'];
            }

            if (isset($meta['newest_id'])) {
                $response['newest_id'] = $meta['newest_id'];
            }

            if (isset($meta['oldest_id'])) {
                $response['oldest_id'] = $meta['oldest_id'];
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
