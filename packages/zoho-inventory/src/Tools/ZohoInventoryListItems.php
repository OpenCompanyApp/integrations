<?php

namespace OpenCompany\Integrations\ZohoInventory\Tools;

use OpenCompany\Integrations\ZohoInventory\ZohoInventoryService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List inventory items (products) from Zoho Inventory.
 *
 * Supports pagination and optional status filtering.
 */
class ZohoInventoryListItems implements Tool
{
    public function __construct(
        private ZohoInventoryService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_inventory_list_items';
    }

    public function description(): string
    {
        return 'List inventory items (products) from Zoho Inventory. Supports pagination and optional filtering by status (active, inactive, all).';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of items per page, max 200 (default: 25).'],
            'status' => ['type' => 'string', 'description' => 'Filter by item status: active, inactive, all.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Inventory integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 25;
            $status = $args['status'] ?? null;

            $result = $this->service->listItems($page, $perPage, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
