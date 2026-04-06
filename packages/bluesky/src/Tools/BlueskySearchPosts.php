<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

use OpenCompany\Integrations\Bluesky\BlueskyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: bluesky_search_posts
 *
 * Search for posts on the Bluesky network via the
 * {@link GET /xrpc/app.bsky.feed.searchPosts} endpoint.
 *
 * Supports full-text search, pagination, and configurable result limits.
 * Returns matching posts with author info, text, timestamps, and engagement metrics.
 *
 * @see https://docs.bsky.app/docs/api/app-bsky-feed-search-posts
 */
class BlueskySearchPosts implements Tool
{
    /**
     * @param  BlueskyService  $service  The Bluesky API client.
     */
    public function __construct(
        private BlueskyService $service,
    ) {}

    /**
     * Machine name of this tool.
     */
    public function name(): string
    {
        return 'bluesky_search_posts';
    }

    /**
     * Human-readable description shown to the AI agent.
     */
    public function description(): string
    {
        return 'Search for posts on Bluesky. Supports full-text search queries. Returns matching posts with author, text, and timestamps.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'q' => ['type' => 'string', 'required' => true, 'description' => 'Search query. Supports search operators like "from:user", "has:images", "lang:en", and boolean combinations.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of results per page (1–100, default 25).'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response to fetch the next page.'],
        ];
    }

    /**
     * Execute the tool — search posts.
     *
     * @param  array  $args  Tool arguments (see {@see parameters()}).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bluesky integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $cursor = $args['cursor'] ?? null;

            $result = $this->service->searchPosts($args['q'], $limit, $cursor);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
