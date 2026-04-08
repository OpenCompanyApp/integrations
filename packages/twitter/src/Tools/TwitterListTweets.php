<?php

namespace OpenCompany\Integrations\Twitter\Tools;

use OpenCompany\Integrations\Twitter\TwitterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list recent tweets with pagination.
 *
 * Retrieves recent tweet data using the Twitter API v2 `GET /2/tweets`
 * endpoint. Supports pagination via `max_results` and `pagination_token`
 * parameters.
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
        return 'List recent tweets from the Twitter API. Returns tweet IDs, text, and optional fields. Supports pagination with max_results and page token.';
    }

    public function parameters(): array
    {
        return [
            'max_results' => ['type' => 'integer', 'description' => 'Number of tweets to return per page (5–100, default: 10).'],
            'page' => ['type' => 'string', 'description' => 'Pagination token from a previous response to get the next page of results.'],
            'tweet_fields' => ['type' => 'array', 'description' => 'Additional tweet fields to include (e.g. created_at, public_metrics, author_id, geo).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitter integration is not configured.');
            }

            $maxResults = isset($args['max_results']) ? (int) $args['max_results'] : 10;
            $paginationToken = $args['page'] ?? null;
            $tweetFields = $args['tweet_fields'] ?? [];

            $result = $this->service->listTweets($maxResults, $paginationToken, $tweetFields);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the Twitter API response into a clean result.
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

        return $response;
    }
}
