<?php

namespace OpenCompany\Integrations\Reddit\Tools;

use OpenCompany\Integrations\Reddit\RedditService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Reddit post.
 *
 * Returns the post data including title, body, score, author,
 * and comment count for the specified post in a subreddit.
 */
class RedditGetPost implements Tool
{
    public function __construct(
        private RedditService $service,
    ) {}

    public function name(): string
    {
        return 'reddit_get_post';
    }

    public function description(): string
    {
        return 'Get details for a specific Reddit post by subreddit and post ID. Returns the post listing and its top-level comments.';
    }

    public function parameters(): array
    {
        return [
            'subreddit' => ['type' => 'string', 'required' => true, 'description' => 'Subreddit name (without r/ prefix).'],
            'post_id' => ['type' => 'string', 'required' => true, 'description' => 'The base36 post ID (e.g., "abc123").'],
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

            $result = $this->service->getPost(
                (string) $args['subreddit'],
                (string) $args['post_id'],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
