<?php

namespace OpenCompany\Integrations\Raindrop\Tools;

use OpenCompany\Integrations\Raindrop\RaindropService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RaindropListBookmarks implements Tool
{
    public function __construct(
        private RaindropService $service,
    ) {}

    public function name(): string
    {
        return 'raindrop_list_bookmarks';
    }

    public function description(): string
    {
        return 'List bookmarks from Raindrop.io. Optionally filter by collection or search query. Returns paginated results with bookmark details.';
    }

    public function parameters(): array
    {
        return [
            'collection_id' => ['type' => 'integer', 'description' => 'Collection ID to filter by. Use 0 for all bookmarks, -1 for unsorted, -99 for trash. Omit to list all.'],
            'search' => ['type' => 'string', 'description' => 'Search query to filter bookmarks by keyword.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (starts at 1, default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (max 50, default: 25).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Raindrop.io integration is not configured.');
            }

            $collectionId = isset($args['collection_id']) ? (int) $args['collection_id'] : null;
            $search = $args['search'] ?? null;
            $page = isset($args['page']) ? max(1, (int) $args['page']) : 1;
            $perPage = isset($args['per_page']) ? min(50, max(1, (int) $args['per_page'])) : 25;

            $result = $this->service->listBookmarks($collectionId, $search, $page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
