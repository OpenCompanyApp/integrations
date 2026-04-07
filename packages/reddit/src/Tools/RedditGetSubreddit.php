<?php

namespace OpenCompany\Integrations\Reddit\Tools;

use OpenCompany\Integrations\Reddit\RedditService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get information about a specific subreddit.
 *
 * Returns subreddit details including subscriber count, description,
 * creation date, and moderation settings.
 */
class RedditGetSubreddit implements Tool
{
    public function __construct(
        private RedditService $service,
    ) {}

    public function name(): string
    {
        return 'reddit_get_subreddit';
    }

    public function description(): string
    {
        return 'Get information about a specific subreddit including subscriber count, description, and settings.';
    }

    public function parameters(): array
    {
        return [
            'subreddit' => ['type' => 'string', 'required' => true, 'description' => 'Subreddit name (without r/ prefix).'],
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

            $result = $this->service->getSubreddit((string) $args['subreddit']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
