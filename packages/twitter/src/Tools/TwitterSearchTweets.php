<?php

namespace OpenCompany\Integrations\Twitter\Tools;

use OpenCompany\Integrations\Twitter\TwitterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to search recent tweets matching a query.
 *
 * Searches tweets using the Twitter API v2 `GET /2/tweets/search/recent`
 * endpoint. Supports query operators, pagination via next_token, and
 * optional field expansions.
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
        return 'Search recent tweets (last 7 days) matching a query. Supports standard Twitter search operators (e.g. from:user, #hashtag, "exact phrase", -exclude). Returns matching tweets with pagination.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'The search query. Supports operators like from:user, to:user, #hashtag, "exact phrase", lang:en, -exclude, is:retweet, has:links, etc.'],
            'max_results' => ['type' => 'integer', 'description' => 'Number of tweets to return per page (10–100, default: 10).'],
            'page' => ['type' => 'string', 'description' => 'Next token from a previous response to get the next page of results.'],
            'tweet_fields' => ['type' => 'array', 'description' => 'Additional tweet fields to include (e.g. created_at, public_metrics, author_id, geo, lang).'],
            'expansions' => ['type' => 'array', 'description' => 'Expansions to include (e.g. author_id to get user objects in includes).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitter integration is not configured.');
            }

            $query = $args['query'];
            $maxResults = isset($args['max_results']) ? (int) $args['max_results'] : 10;
            $nextToken = $args['page'] ?? null;
            $tweetFields = $args['tweet_fields'] ?? [];
            $expansions = $args['expansions'] ?? [];

            $result = $this->service->searchTweets($query, $maxResults, $nextToken, $tweetFields, $expansions);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the Twitter API search response into a clean result.
     *
     * @param  array<string, mixed>  $result
     * @return array<string, mixed>
     */
    private function formatResponse(array $result): array
    {
        $tweets = $result['data'] ?? [];
        $meta = $result['meta'] ?? [];

        $response = [
            'tweets' => array_map(function (array $tweet) {
                return [
                    'id' => $tweet['id'] ?? null,
                    'text' => $tweet['text'] ?? null,
                ] + array_diff_key($tweet, ['id' => null, 'text' => null]);
            }, $tweets),
            'count' => count($tweets),
        ];

        if (isset($meta['next_token'])) {
            $response['next_page'] = $meta['next_token'];
        }

        if (isset($meta['result_count'])) {
            $response['total_results'] = $meta['result_count'];
        }

        if (isset($result['includes'])) {
            $response['includes'] = $result['includes'];
        }

        return $response;
    }
}
