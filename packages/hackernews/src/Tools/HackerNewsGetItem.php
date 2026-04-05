<?php

namespace OpenCompany\Integrations\HackerNews\Tools;

use OpenCompany\Integrations\HackerNews\HackerNewsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch a single Hacker News item by its ID.
 *
 * Items include stories, comments, jobs, polls, andpollopt entries.
 * Returns the full item data including title, URL, text, author, score,
 * descendants, and child IDs.
 *
 * @see https://github.com/HackerNews/API#items
 */
class HackerNewsGetItem implements Tool
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
        return 'hackernews_get_item';
    }

    /**
     * Human-readable description for tool catalogs.
     */
    public function description(): string
    {
        return 'Fetch a Hacker News item (story, comment, job, poll, or poll option) by its numeric ID. Returns all available fields: title, URL, text, author (by), score, time, descendants, and kids (child comment IDs). Use this to look up any HN item when you know its ID.';
    }

    /**
     * Parameter definitions.
     *
     * @return array<string, array{type: string, required: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Hacker News item ID (e.g., 12345).'],
        ];
    }

    /**
     * Execute the tool — fetch the item and return its data.
     *
     * @param  array<string, mixed>  $args  Keyed arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            $id = (int) ($args['id'] ?? 0);

            if ($id <= 0) {
                return ToolResult::error('A valid positive item ID is required.');
            }

            $item = $this->service->getItem($id);

            if ($item === null) {
                return ToolResult::error("Item {$id} not found or the Hacker News API is unavailable.");
            }

            return ToolResult::success([
                'id' => $item['id'] ?? $id,
                'type' => $item['type'] ?? null,
                'title' => $item['title'] ?? null,
                'url' => $item['url'] ?? null,
                'text' => $item['text'] ?? null,
                'by' => $item['by'] ?? null,
                'score' => $item['score'] ?? null,
                'time' => $item['time'] ?? null,
                'time_iso' => isset($item['time']) ? gmdate('c', $item['time']) : null,
                'descendants' => $item['descendants'] ?? null,
                'kids' => $item['kids'] ?? [],
                'parent' => $item['parent'] ?? null,
                'poll' => $item['poll'] ?? null,
                'parts' => $item['parts'] ?? [],
                'deleted' => $item['deleted'] ?? false,
                'dead' => $item['dead'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
