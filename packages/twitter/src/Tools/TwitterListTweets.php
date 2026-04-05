<?php

namespace OpenCompany\Integrations\Twitter\Tools;

use OpenCompany\Integrations\Twitter\TwitterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list recent tweets from a Twitter user.
 *
 * Calls `GET /users/{id}/tweets` on the Twitter API v2.
 */
class TwitterListTweets implements Tool
{
    public function __construct(
        private TwitterService $service,
    ) {}

    public function name(): string
    {
        return 'twitter_list_tweets';
    }

    public function description(): string
    {
        return 'List recent tweets from a Twitter user by their user ID. Returns tweet text, IDs, and creation dates.';
    }

    public function parameters(): array
    {
        return [
            'user_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Twitter user ID whose tweets to list.',
            ],
            'max_results' => [
                'type' => 'integer',
                'description' => 'Number of tweets to return (10–100, default 10).',
            ],
            'tweet_fields' => [
                'type' => 'array',
                'description' => 'Additional tweet fields to include: attachments, author_id, context_annotations, conversation_id, created_at, edit_controls, entities, geo, id, in_reply_to_user_id, lang, non_public_metrics, note_tweet, organic_metrics, possibly_sensitive, promoted_metrics, public_metrics, referenced_tweets, reply_settings, source, text, withheld.',
            ],
            'pagination_token' => [
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
            $paginationToken = $args['pagination_token'] ?? null;

            $result = $this->service->listTweets($args['user_id'], $maxResults, $tweetFields, $paginationToken);

            $tweets = $result['data'] ?? [];
            $meta = $result['meta'] ?? [];

            $response = [
                'tweets' => $tweets,
                'count' => count($tweets),
            ];

            if (isset($meta['next_token'])) {
                $response['next_token'] = $meta['next_token'];
            }

            if (isset($meta['result_count'])) {
                $response['total_results'] = $meta['result_count'];
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
