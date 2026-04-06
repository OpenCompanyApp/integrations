<?php

namespace OpenCompany\Integrations\Matrix\Tools;

use OpenCompany\Integrations\Matrix\MatrixService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MatrixListRooms implements Tool
{
    public function __construct(
        private MatrixService $service,
    ) {}

    public function name(): string
    {
        return 'matrix_list_rooms';
    }

    public function description(): string
    {
        return 'List rooms the authenticated user has joined on Matrix. Returns room IDs, names, and aliases.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of rooms to return (default: 50).'],
            'from' => ['type' => 'string', 'description' => 'Pagination token from a previous response to get the next page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Matrix integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $result = $this->service->listRooms($limit, $args['from'] ?? null);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
