<?php

namespace OpenCompany\Integrations\Reddit\Tools;

use OpenCompany\Integrations\Reddit\RedditService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for searching Reddit for posts, subreddits, and users.
 *
 * Uses Reddit's `/search` endpoint to find content matching a query string.
 * Supports filtering by type (links, subreddits, users), sorting, and
 * time range.
 */
class RedditSearch implements Tool
{
    /**
     * Create a new RedditSearch tool instance.
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
        return 'reddit_search';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Search Reddit for posts, subreddits, or users. Supports filtering by type, sorting, and time range. Use this to find relevant content across Reddit.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'The search query string.'],
            'type' => ['type' => 'string', 'description' => 'Result type: "link" (posts), "sr" (subreddits), "user", or comma-separated combinations. Default: "link".'],
            'sort' => ['type' => 'string', 'description' => 'Sort order: "relevance", "hot", "top", "new", or "comments". Default: "relevance".'],
            'time' => ['type' => 'string', 'description' => 'Time range: "hour", "day", "week", "month", "year", or "all". Default: "all".'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results (default: 25, max: 100).'],
            'after' => ['type' => 'string', 'description' => 'Pagination cursor — fullname of the last result from a previous response.'],
        ];
    }

    /**
     * Execute the tool: search Reddit for matching content.
     *
     * @param  array<string, mixed>  $args  Tool arguments including 'query', and optional 'type', 'sort', 'time', 'limit', 'after'.
     * @return ToolResult The result containing search results or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Reddit integration is not configured.');
            }

            $query = $args['query'];
            $type = $args['type'] ?? 'link';
            $sort = $args['sort'] ?? 'relevance';
            $time = $args['time'] ?? 'all';
            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $after = $args['after'] ?? null;

            $result = $this->service->search($query, $type, $sort, $time, $limit, $after);

            return ToolResult::success($this->formatResponse($result, $query, $type));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the Reddit search API response into a structured result.
     *
     * @param  array<string, mixed>  $result  Raw Reddit API response.
     * @param  string  $query  The search query that was used.
     * @param  string  $type  The search type that was used.
     * @return array<string, mixed> Formatted response with search results and pagination info.
     */
    private function formatResponse(array $result, string $query, string $type): array
    {
        $data = $result['data'] ?? [];
        $children = $data['children'] ?? [];

        $items = array_map(function (array $child) use ($type): array {
            $item = $child['data'] ?? [];
            $kind = $child['kind'] ?? '';

            if ($kind === 't3') {
                return [
                    'type' => 'post',
                    'id' => $item['id'] ?? null,
                    'title' => $item['title'] ?? null,
                    'author' => $item['author'] ?? null,
                    'subreddit' => $item['subreddit'] ?? null,
                    'score' => $item['score'] ?? 0,
                    'numComments' => $item['num_comments'] ?? 0,
                    'url' => $item['url'] ?? null,
                    'permalink' => isset($item['permalink']) ? 'https://www.reddit.com' . $item['permalink'] : null,
                    'createdUtc' => $item['created_utc'] ?? null,
                ];
            }

            if ($kind === 't5') {
                return [
                    'type' => 'subreddit',
                    'id' => $item['id'] ?? null,
                    'name' => $item['display_name'] ?? null,
                    'title' => $item['title'] ?? null,
                    'subscribers' => $item['subscribers'] ?? 0,
                    'description' => isset($item['public_description']) ? mb_substr($item['public_description'], 0, 200) : null,
                    'url' => isset($item['url']) ? 'https://www.reddit.com' . $item['url'] : null,
                ];
            }

            return $item;
        }, $children);

        return [
            'query' => $query,
            'type' => $type,
            'results' => $items,
            'count' => count($items),
            'after' => $data['after'] ?? null,
        ];
    }
}
