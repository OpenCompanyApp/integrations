<?php

namespace OpenCompany\Integrations\Droplr\Tools;

use OpenCompany\Integrations\Droplr\DroplrService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DroplrListDrops implements Tool
{
    public function __construct(
        private DroplrService $service,
    ) {}

    public function name(): string
    {
        return 'droplr_list_drops';
    }

    public function description(): string
    {
        return 'List drops (short links, files, images, notes) from Droplr. Supports filtering by type and search query, with pagination.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of results per page (default: 20, max: 100).'],
            'type' => ['type' => 'string', 'description' => 'Filter by drop type: LINK, IMAGE, FILE, or NOTE.'],
            'q' => ['type' => 'string', 'description' => 'Search query to filter drops by title or content.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Droplr integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $type = $args['type'] ?? null;
            $query = $args['q'] ?? null;

            $result = $this->service->listDrops($page, $limit, $type, $query);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
