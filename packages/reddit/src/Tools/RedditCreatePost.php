<?php

namespace OpenCompany\Integrations\Reddit\Tools;

use OpenCompany\Integrations\Reddit\RedditService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for submitting a new post to a subreddit on Reddit.
 *
 * Supports text (self) posts, link posts, image posts, and video posts
 * via Reddit's `/api/submit` endpoint. Requires write permissions on
 * the OAuth2 token.
 */
class RedditCreatePost implements Tool
{
    /**
     * Create a new RedditCreatePost tool instance.
     *
     * @param  RedditService  $service  The Reddit API service for making authenticated requests.
     */
    public function __construct(
        private RedditService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'reddit_create_post';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Submit a new post to a subreddit on Reddit. Supports text posts (self), link posts, images, and videos. Requires the account to have posting privileges in the target subreddit.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'subreddit' => ['type' => 'string', 'required' => true, 'description' => 'The subreddit name without the r/ prefix (e.g., "laravel").'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title of the post (max 300 characters).'],
            'kind' => ['type' => 'string', 'description' => 'Post type: "self" (text post), "link", "image", or "video". Default: "self".'],
            'text' => ['type' => 'string', 'description' => 'The body text for self posts. Supports Markdown formatting. Required when kind is "self".'],
            'url' => ['type' => 'string', 'description' => 'The URL for link, image, or video posts. Required when kind is "link", "image", or "video".'],
        ];
    }

    /**
     * Execute the tool: submit a new post to a subreddit.
     *
     * @param  array<string, mixed>  $args  Tool arguments including 'subreddit', 'title', and optional 'kind', 'text', 'url'.
     * @return ToolResult The result confirming post creation or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Reddit integration is not configured.');
            }

            $subreddit = $args['subreddit'];
            $title = $args['title'];
            $kind = $args['kind'] ?? 'self';
            $text = $args['text'] ?? null;
            $url = $args['url'] ?? null;

            if ($kind === 'self' && empty($text)) {
                return ToolResult::error('The "text" parameter is required when creating a self (text) post.');
            }

            if (in_array($kind, ['link', 'image', 'video']) && empty($url)) {
                return ToolResult::error("The \"url\" parameter is required when creating a {$kind} post.");
            }

            $result = $this->service->createPost($subreddit, $title, $kind, $text, $url);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the Reddit submit API response into a structured result.
     *
     * @param  array<string, mixed>  $result  Raw Reddit API response.
     * @return array<string, mixed> Formatted response with post creation details.
     */
    private function formatResponse(array $result): array
    {
        $json = $result['json'] ?? [];
        $data = $json['data'] ?? [];

        if (($json['errors'] ?? []) !== []) {
            $errors = array_map(fn ($e) => implode(': ', $e), $json['errors']);
            return [
                'success' => false,
                'errors' => $errors,
            ];
        }

        return [
            'success' => true,
            'id' => $data['id'] ?? null,
            'name' => $data['name'] ?? null,
            'url' => $data['url'] ?? null,
            'permalink' => isset($data['url']) ? 'https://www.reddit.com' . $data['url'] : null,
        ];
    }
}
