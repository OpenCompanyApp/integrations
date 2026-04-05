<?php

namespace OpenCompany\Integrations\Reddit\Tools;

use OpenCompany\Integrations\Reddit\RedditService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing popular subreddits on Reddit.
 *
 * Retrieves a list of popular/trending subreddits using Reddit's
 * `/subreddits/popular` endpoint. Useful for discovering active
 * communities.
 */
class RedditListSubreddits implements Tool
{
    /**
     * Create a new RedditListSubreddits tool instance.
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
        return 'reddit_list_subreddits';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List popular subreddits on Reddit. Returns subreddit names, subscriber counts, and descriptions. Use for discovering trending communities.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of subreddits to return (default: 25, max: 100).'],
            'after' => ['type' => 'string', 'description' => 'Pagination cursor — fullname of the last subreddit from a previous response.'],
        ];
    }

    /**
     * Execute the tool: fetch popular subreddits.
     *
     * @param  array<string, mixed>  $args  Tool arguments including optional 'limit' and 'after'.
     * @return ToolResult The result containing subreddit listings or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Reddit integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $after = $args['after'] ?? null;

            $result = $this->service->listSubreddits($limit, $after);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the Reddit subreddits listing response into a structured result.
     *
     * @param  array<string, mixed>  $result  Raw Reddit API response.
     * @return array<string, mixed> Formatted response with subreddit data and pagination info.
     */
    private function formatResponse(array $result): array
    {
        $data = $result['data'] ?? [];
        $children = $data['children'] ?? [];

        $subreddits = array_map(function (array $child): array {
            $sr = $child['data'] ?? [];
            return [
                'id' => $sr['id'] ?? null,
                'name' => $sr['display_name'] ?? null,
                'title' => $sr['title'] ?? null,
                'subscribers' => $sr['subscribers'] ?? 0,
                'description' => $sr['public_description'] ?? null,
                'url' => isset($sr['url']) ? 'https://www.reddit.com' . $sr['url'] : null,
                'over18' => $sr['over18'] ?? false,
                'createdUtc' => $sr['created_utc'] ?? null,
            ];
        }, $children);

        return [
            'subreddits' => $subreddits,
            'count' => count($subreddits),
            'after' => $data['after'] ?? null,
        ];
    }
}
