<?php

namespace OpenCompany\Integrations\Reddit\Tools;

use OpenCompany\Integrations\Reddit\RedditService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Submit a new post to a subreddit.
 *
 * Creates a new post (text, link, image, or video) in the specified
 * subreddit. Requires the subreddit name, title, and post kind.
 */
class RedditCreatePost implements Tool
{
    public function __construct(
        private RedditService $service,
    ) {}

    public function name(): string
    {
        return 'reddit_create_post';
    }

    public function description(): string
    {
        return 'Submit a new post to a subreddit. Supports text (self), link, image, and video post types.';
    }

    public function parameters(): array
    {
        return [
            'subreddit' => ['type' => 'string', 'required' => true, 'description' => 'Subreddit name (without r/ prefix).'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'Post title.'],
            'kind' => ['type' => 'string', 'description' => 'Post type: self (text), link, image, or video (default: self).'],
            'text' => ['type' => 'string', 'description' => 'Post body text (for self/text posts). Supports Markdown.'],
            'url' => ['type' => 'string', 'description' => 'URL (required for link posts).'],
            'nsfw' => ['type' => 'boolean', 'description' => 'Whether the post is NSFW (default: false).'],
            'spoiler' => ['type' => 'boolean', 'description' => 'Whether the post is a spoiler (default: false).'],
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

            if (empty($args['title'])) {
                return ToolResult::error('Title is required.');
            }

            $kind = isset($args['kind']) ? (string) $args['kind'] : 'self';
            $text = isset($args['text']) ? (string) $args['text'] : '';
            $url = isset($args['url']) ? (string) $args['url'] : '';
            $nsfw = isset($args['nsfw']) ? (bool) $args['nsfw'] : false;
            $spoiler = isset($args['spoiler']) ? (bool) $args['spoiler'] : false;

            $result = $this->service->createPost(
                (string) $args['subreddit'],
                (string) $args['title'],
                $kind,
                $text,
                $url,
                $nsfw,
                $spoiler,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
