<?php

namespace OpenCompany\Integrations\Box\Tools;

use OpenCompany\Integrations\Box\BoxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BoxSearch implements Tool
{
    /**
     * Create a new BoxSearch tool instance.
     */
    public function __construct(
        private BoxService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'box_search';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Search for files and folders in Box. Returns matching items with names, IDs, types, and paths. Useful for finding files by name or content.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'The search query string.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results (1–200, default: 50).'],
            'offset' => ['type' => 'integer', 'description' => 'Zero-based offset for pagination (default: 0).'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Box integration is not configured.');
            }

            $query = $args['query'];
            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->search($query, $limit, $offset);

            $entries = $result['entries'] ?? [];
            $totalCount = $result['total_count'] ?? count($entries);

            $items = array_map(function (array $entry): array {
                return [
                    'id' => $entry['id'] ?? null,
                    'type' => $entry['type'] ?? null,
                    'name' => $entry['name'] ?? null,
                    'size' => $entry['size'] ?? null,
                    'modified_at' => $entry['modified_at'] ?? null,
                    'path_collection' => $entry['path_collection'] ?? null,
                ];
            }, $entries);

            return ToolResult::success([
                'query' => $query,
                'items' => $items,
                'total_count' => $totalCount,
                'offset' => $offset,
                'limit' => $limit,
                'has_more' => ($offset + count($items)) < $totalCount,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
