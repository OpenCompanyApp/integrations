<?php

namespace OpenCompany\Integrations\Reddit\Tools;

use OpenCompany\Integrations\Reddit\RedditService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List comments for a specific Reddit post.
 *
 * Returns a threaded list of comments for the specified post,
 * with configurable sort order and depth limit.
 */
class RedditListComments implements Tool
{
    public function __construct(
        private RedditService $service,
    ) {}

    public function name(): string
    {
        return 'reddit_list_comments';
    }

    public function description(): string
    {
        return 'List comments for a specific Reddit post. Supports sorting (best, top, new, controversial, old, q&a) and depth limiting.';
    }

    public function parameters(): array
    {
        return [
            'subreddit' => ['type' => 'string', 'required' => true, 'description' => 'Subreddit name (without r/ prefix).'],
            'post_id' => ['type' => 'string', 'required' => true, 'description' => 'The base36 post ID (e.g., "abc123").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of comments to return (default: 25, max: 100).'],
            'sort' => ['type' => 'string', 'description' => 'Comment sort order: best, top, new, controversial, old, q&a (default: best).'],
            'depth' => ['type' => 'integer', 'description' => 'Maximum comment depth (default: unlimited).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Reddit integration is not configured.');
            }

            if (empty($args['subreddit'])) {
                return ToolResult::error('Subreddit is required.');
            }

            if (empty($args['post_id'])) {
                return ToolResult::error('Post ID is required.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $sort = isset($args['sort']) ? (string) $args['sort'] : 'best';
            $depth = isset($args['depth']) ? (int) $args['depth'] : 0;

            $result = $this->service->listComments(
                (string) $args['subreddit'],
                (string) $args['post_id'],
                $limit,
                $sort,
                $depth,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
