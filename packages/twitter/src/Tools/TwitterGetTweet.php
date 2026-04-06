<?php

namespace OpenCompany\Integrations\Twitter\Tools;

use OpenCompany\Integrations\Twitter\TwitterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve a single tweet by ID.
 *
 * Fetches a tweet using the Twitter API v2 `GET /2/tweets/:id` endpoint.
 * Supports requesting additional tweet fields and expansions such as
 * author information.
 */
class TwitterGetTweet implements Tool
{
    public function __construct(
        private TwitterService $service,
    ) {}

    public function name(): string
    {
        return 'twitter_get_tweet';
    }

    public function description(): string
    {
        return 'Get a single tweet by its ID. Returns the tweet text, ID, and any requested additional fields (e.g. created_at, public_metrics, author_id).';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The tweet ID to retrieve.'],
            'tweet_fields' => ['type' => 'array', 'description' => 'Additional tweet fields to include (e.g. created_at, public_metrics, author_id, geo, lang).'],
            'expansions' => ['type' => 'array', 'description' => 'Expansions to include (e.g. author_id, referenced_tweets.id).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitter integration is not configured.');
            }

            $id = $args['id'];
            $tweetFields = $args['tweet_fields'] ?? [];
            $expansions = $args['expansions'] ?? [];

            $result = $this->service->getTweet($id, $tweetFields, $expansions);

            $tweet = $result['data'] ?? null;
            if (!$tweet) {
                return ToolResult::error("Tweet with ID '{$id}' not found.");
            }

            $response = [
                'id' => $tweet['id'] ?? null,
                'text' => $tweet['text'] ?? null,
            ] + array_diff_key($tweet, ['id' => null, 'text' => null]);

            if (isset($result['includes'])) {
                $response['includes'] = $result['includes'];
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
