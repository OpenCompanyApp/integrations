<?php

namespace OpenCompany\Integrations\Reddit\Tools;

use OpenCompany\Integrations\Reddit\RedditService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving detailed information about a specific subreddit.
 *
 * Fetches subreddit metadata including description, subscriber count,
 * rules, and configuration using Reddit's `/r/{name}/about` endpoint.
 */
class RedditGetSubreddit implements Tool
{
    /**
     * Create a new RedditGetSubreddit tool instance.
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
        return 'reddit_get_subreddit';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get detailed information about a subreddit, including its description, subscriber count, rules, and posting guidelines.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The subreddit name without the r/ prefix (e.g., "laravel").'],
        ];
    }

    /**
     * Execute the tool: fetch subreddit details.
     *
     * @param  array<string, mixed>  $args  Tool arguments including 'name'.
     * @return ToolResult The result containing subreddit details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Reddit integration is not configured.');
            }

            $name = $args['name'];
            $result = $this->service->getSubreddit($name);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the Reddit subreddit about response into a structured result.
     *
     * @param  array<string, mixed>  $result  Raw Reddit API response.
     * @return array<string, mixed> Formatted subreddit details.
     */
    private function formatResponse(array $result): array
    {
        $data = $result['data'] ?? [];

        return [
            'id' => $data['id'] ?? null,
            'name' => $data['display_name'] ?? null,
            'title' => $data['title'] ?? null,
            'description' => $data['public_description'] ?? null,
            'descriptionHtml' => $data['description_html'] ?? null,
            'subscribers' => $data['subscribers'] ?? 0,
            'activeUsers' => $data['active_user_count'] ?? 0,
            'url' => isset($data['url']) ? 'https://www.reddit.com' . $data['url'] : null,
            'over18' => $data['over18'] ?? false,
            'submissionType' => $data['submission_type'] ?? 'any',
            'subredditType' => $data['subreddit_type'] ?? null,
            'createdUtc' => $data['created_utc'] ?? null,
            'headerImageUrl' => $data['header_img'] ?? null,
            'iconUrl' => $data['community_icon'] ?? ($data['icon_img'] ?? null),
        ];
    }
}
