<?php

namespace OpenCompany\Integrations\Box\Tools;

use OpenCompany\Integrations\Box\BoxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BoxListFiles implements Tool
{
    /**
     * Create a new BoxListFiles tool instance.
     */
    public function __construct(
        private BoxService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'box_list_files';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List files and folders in a Box folder. Returns item names, IDs, types (file or folder), sizes, and modification dates. Use folder ID "0" for the root folder.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'folder_id' => ['type' => 'string', 'description' => 'The folder ID to list. Use "0" for the root folder.', 'default' => '0'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of items to return (1–1000, default: 100).'],
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

            $folderId = $args['folder_id'] ?? '0';
            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listFiles($folderId, $limit, $offset);

            $entries = $result['entries'] ?? [];
            $totalCount = $result['total_count'] ?? count($entries);
            $offset = $result['offset'] ?? $offset;

            $items = array_map(function (array $entry): array {
                return [
                    'id' => $entry['id'] ?? null,
                    'type' => $entry['type'] ?? null,
                    'name' => $entry['name'] ?? null,
                    'size' => $entry['size'] ?? null,
                    'modified_at' => $entry['modified_at'] ?? null,
                ];
            }, $entries);

            return ToolResult::success([
                'folder_id' => $folderId,
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
