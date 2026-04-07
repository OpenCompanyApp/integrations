<?php

namespace OpenCompany\Integrations\Reddit\Tools;

use OpenCompany\Integrations\Reddit\RedditService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List popular or new subreddits.
 *
 * Returns a paginated list of subreddits sorted by popularity
 * or creation date.
 */
class RedditListSubreddits implements Tool
{
    public function __construct(
        private RedditService $service,
    ) {}

    public function name(): string
    {
        return 'reddit_list_subreddits';
    }

    public function description(): string
    {
        return 'List popular or new subreddits. Supports pagination with after/before cursors.';
    }

    public function parameters(): array
    {
        return [
            'sort' => ['type' => 'string', 'description' => 'Sort method: popular or new (default: popular).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of subreddits to return (default: 25, max: 100).'],
            'after' => ['type' => 'string', 'description' => 'Fullname of a subreddit to fetch results after (for pagination).'],
            'before' => ['type' => 'string', 'description' => 'Fullname of a subreddit to fetch results before (for pagination).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Reddit integration is not configured.');
            }

            $sort = isset($args['sort']) ? (string) $args['sort'] : 'popular';
            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $after = isset($args['after']) ? (string) $args['after'] : null;
            $before = isset($args['before']) ? (string) $args['before'] : null;

            $result = $this->service->listSubreddits($sort, $limit, $after, $before);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
