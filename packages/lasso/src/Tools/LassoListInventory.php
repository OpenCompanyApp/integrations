<?php

namespace OpenCompany\Integrations\Lasso\Tools;

use OpenCompany\Integrations\Lasso\LassoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Inventory.
 *
 * Lists available inventory (units/lots) in Lasso CRM with optional
 * filtering and pagination support.
 */
class LassoListInventory implements Tool
{
    /**
     * @param  LassoService  $service  The Lasso API service instance.
     */
    public function __construct(
        private LassoService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'lasso_list_inventory';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List available inventory (units/lots) in Lasso CRM. Optionally filter by project ID or status. Supports pagination.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'description' => 'Filter inventory by project ID.'],
            'status'     => ['type' => 'string', 'description' => 'Filter by inventory status (e.g., "Available", "Sold", "Reserved").'],
            'limit'      => ['type' => 'integer', 'description' => 'Maximum number of inventory items to return (default: 25).'],
            'page'       => ['type' => 'integer', 'description' => 'Page number for pagination.'],
        ];
    }

    /**
     * Execute the list inventory tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, status, limit, page).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Lasso CRM integration is not configured.');
            }

            $filters = [];
            if (isset($args['project_id'])) {
                $filters['project_id'] = $args['project_id'];
            }
            if (isset($args['status'])) {
                $filters['status'] = $args['status'];
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page  = isset($args['page']) ? (int) $args['page'] : null;

            $result = $this->service->listInventory($filters, $limit, $page);

            $inventory = $result['data'] ?? [];
            $total     = $result['total'] ?? count($inventory);

            return ToolResult::success([
                'inventory' => $inventory,
                'count'     => count($inventory),
                'total'     => $total,
                'page'      => $result['current_page'] ?? $page ?? 1,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
