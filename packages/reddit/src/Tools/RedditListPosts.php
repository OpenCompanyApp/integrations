<?php

namespace OpenCompany\Integrations\Reddit\Tools;

use OpenCompany\Integrations\Reddit\RedditService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List posts from a subreddit or the Reddit front page.
 *
 * Returns a paginated list of posts sorted by the specified method.
 * Use the `subreddit` parameter to specify a subreddit, or leave empty
 * for the front page. Supports hot, new, top, rising, and controversial sorting.
 */
class RedditListPosts implements Tool
{
    public function __construct(
        private RedditService $service,
    ) {}

    public function name(): string
    {
        return 'reddit_list_posts';
    }

    public function description(): string
    {
        return 'List posts from a subreddit or the Reddit front page. Supports hot, new, top, rising, and controversial sorting with pagination via after/before cursors.';
    }

    public function parameters(): array
    {
        return [
            'subreddit' => ['type' => 'string', 'description' => 'Subreddit name (without r/ prefix). Leave empty for front page.'],
            'sort' => ['type' => 'string', 'description' => 'Sort method: hot, new, top, rising, controversial (default: hot).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of posts to return (default: 25, max: 100).'],
            'after' => ['type' => 'string', 'description' => 'Fullname of a post to fetch results after (for pagination).'],
            'before' => ['type' => 'string', 'description' => 'Fullname of a post to fetch results before (for pagination).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Reddit integration is not configured.');
            }

            $subreddit = isset($args['subreddit']) ? (string) $args['subreddit'] : '';
            $sort = isset($args['sort']) ? (string) $args['sort'] : 'hot';
            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $after = isset($args['after']) ? (string) $args['after'] : null;
            $before = isset($args['before']) ? (string) $args['before'] : null;

            $result = $this->service->listPosts($subreddit, $sort, $limit, $after, $before);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
