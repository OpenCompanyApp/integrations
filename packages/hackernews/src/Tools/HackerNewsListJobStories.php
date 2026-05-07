<?php

namespace OpenCompany\Integrations\HackerNews\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\HackerNews\HackerNewsService;

/**
 * Fetch the latest job stories from the official Hacker News API.
 *
 * The HN API returns up to 200 job item IDs; this tool resolves the first N to full item data.
 */
class HackerNewsListJobStories implements Tool
{
    /**
     * @param  HackerNewsService  $service  The HN API service instance.
     */
    public function __construct(
        private HackerNewsService $service,
    ) {}

    public function name(): string
    {
        return 'hackernews_list_job_stories';
    }

    public function description(): string
    {
        return 'Fetch the latest Hacker News job stories. Returns up to N job items with title, URL/text, author, score, and time.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum number of job stories to return (default: 30, max: 100).', 'default' => 30],
        ];
    }

    /**
     * Fetch job story IDs and resolve them to item payloads.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit).
     */
    public function execute(array $args): ToolResult
    {
        try {
            $limit = min(max((int) ($args['limit'] ?? 30), 1), 100);
            $ids = $this->service->jobStories();

            if ($ids === []) {
                return ToolResult::error('Failed to fetch job stories from Hacker News. The API may be temporarily unavailable.');
            }

            return ToolResult::success([
                'type' => 'job',
                'total_ids' => count($ids),
                'limit' => $limit,
                'stories' => array_map([$this, 'formatItem'], $this->service->fetchItems($ids, $limit)),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format a single HN item for story-list responses.
     *
     * @param  array<string, mixed>  $item  Raw HN item payload.
     * @return array<string, mixed>
     */
    private function formatItem(array $item): array
    {
        return [
            'id' => $item['id'] ?? null,
            'title' => $item['title'] ?? null,
            'url' => $item['url'] ?? null,
            'text' => $item['text'] ?? null,
            'by' => $item['by'] ?? null,
            'score' => $item['score'] ?? null,
            'time' => $item['time'] ?? null,
            'time_iso' => isset($item['time']) ? gmdate('c', $item['time']) : null,
            'descendants' => $item['descendants'] ?? 0,
            'type' => $item['type'] ?? null,
        ];
    }
}
