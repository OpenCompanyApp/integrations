<?php

namespace OpenCompany\Integrations\HackerNews\Tools;

use OpenCompany\Integrations\HackerNews\HackerNewsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch the best (highest-scoring) stories from Hacker News.
 *
 * The HN API returns an ordered list of up to ~500 item IDs for the
 * "best" stories. This tool fetches the list and then retrieves the
 * full item data for the top N stories.
 *
 * @see https://github.com/HackerNews/API#new-top-and-best-stories
 */
class HackerNewsListBestStories implements Tool
{
    /**
     * @param  HackerNewsService  $service  The HN API service instance
     */
    public function __construct(
        private HackerNewsService $service,
    ) {}

    /**
     * Tool slug used for routing.
     */
    public function name(): string
    {
        return 'hackernews_list_best_stories';
    }

    /**
     * Human-readable description for tool catalogs.
     */
    public function description(): string
    {
        return 'Fetch the highest-scoring (best) stories from Hacker News. Returns up to N stories with full item data (title, URL, score, author, comment count). These are the stories with the highest scores, regardless of age.';
    }

    /**
     * Parameter definitions.
     *
     * @return array<string, array{type: string, required: bool, description: string, default?: mixed}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum number of stories to return (default: 30, max: 100).', 'default' => 30],
        ];
    }

    /**
     * Execute the tool — fetch best story IDs and resolve to full items.
     *
     * @param  array<string, mixed>  $args  Keyed arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            $limit = min(max((int) ($args['limit'] ?? 30), 1), 100);

            $ids = $this->service->bestStories();

            if (empty($ids)) {
                return ToolResult::error('Failed to fetch best stories from Hacker News. The API may be temporarily unavailable.');
            }

            $items = $this->service->fetchItems($ids, $limit);

            return ToolResult::success([
                'type' => 'best',
                'total_ids' => count($ids),
                'limit' => $limit,
                'stories' => array_map([$this, 'formatItem'], $items),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format a single item for the response.
     *
     * @param  array<string, mixed>  $item
     * @return array<string, mixed>
     */
    private function formatItem(array $item): array
    {
        return [
            'id' => $item['id'] ?? null,
            'title' => $item['title'] ?? null,
            'url' => $item['url'] ?? null,
            'by' => $item['by'] ?? null,
            'score' => $item['score'] ?? null,
            'time' => $item['time'] ?? null,
            'time_iso' => isset($item['time']) ? gmdate('c', $item['time']) : null,
            'descendants' => $item['descendants'] ?? 0,
            'type' => $item['type'] ?? null,
        ];
    }
}
