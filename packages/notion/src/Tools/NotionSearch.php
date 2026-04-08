<?php

namespace OpenCompany\Integrations\Notion\Tools;

use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search across pages and databases in a Notion workspace.
 */
class NotionSearch implements Tool
{
    /**
     * @param  NotionService  $service  The Notion API client
     */
    public function __construct(
        private NotionService $service,
    ) {}

    public function name(): string
    {
        return 'notion_search';
    }

    public function description(): string
    {
        return <<<'MD'
        Search pages and databases in your Notion workspace.
        Returns matching results with their IDs, types, and titles.
        Optionally filter by type (page or database) and control sort direction.
        MD;
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'description' => 'Search query text.'],
            'filter_type' => ['type' => 'string', 'description' => 'Filter results by type: "page" or "database".'],
            'sort_direction' => ['type' => 'string', 'description' => 'Sort direction: "ascending" or "descending". Defaults to descending (last edited first).'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of results per page (max 100, default 10).'],
            'start_cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
        ];
    }

    /**
     * Search pages and databases in the connected workspace.
     *
     * @param  array<string, mixed>  $args  Tool arguments (query, filter_type, sort_direction, page_size, start_cursor)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Notion integration is not configured.');
            }

            $body = [];

            if (isset($args['query'])) {
                $body['query'] = $args['query'];
            }

            if (isset($args['filter_type'])) {
                $body['filter'] = ['value' => $args['filter_type'], 'property' => 'object'];
            }

            if (isset($args['sort_direction'])) {
                $body['sort'] = ['direction' => $args['sort_direction'], 'timestamp' => 'last_edited_time'];
            }

            if (isset($args['page_size'])) {
                $body['page_size'] = min((int) $args['page_size'], 100);
            }

            if (isset($args['start_cursor'])) {
                $body['start_cursor'] = $args['start_cursor'];
            }

            $result = $this->service->search($body);
            $results = $result['results'] ?? [];

            if (empty($results)) {
                return ToolResult::success('No results found.');
            }

            $output = [];
            foreach ($results as $item) {
                $title = $this->extractTitle($item);
                $output[] = [
                    'id' => $item['id'] ?? '',
                    'type' => $item['object'] ?? '',
                    'title' => $title,
                    'url' => $item['url'] ?? '',
                    'last_edited_time' => $item['last_edited_time'] ?? null,
                ];
            }

            $response = ['count' => count($output), 'results' => $output];

            if (isset($result['has_more']) && $result['has_more']) {
                $response['has_more'] = true;
                $response['next_cursor'] = $result['next_cursor'] ?? null;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * @param  array<string, mixed>  $item
     */
    private function extractTitle(array $item): string
    {
        $props = $item['properties'] ?? [];
        $titleProp = $props['title'] ?? null;

        if ($titleProp && isset($titleProp['title'])) {
            return implode('', array_map(fn (array $t) => $t['plain_text'] ?? '', $titleProp['title']));
        }

        // For databases, title might be at a different path
        $titleArr = $item['title'] ?? [];
        if (is_array($titleArr)) {
            return implode('', array_map(fn (array $t) => $t['plain_text'] ?? '', $titleArr));
        }

        return 'Untitled';
    }
}
