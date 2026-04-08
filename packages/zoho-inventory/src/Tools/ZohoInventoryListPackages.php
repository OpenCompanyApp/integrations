<?php

namespace OpenCompany\Integrations\ZohoInventory\Tools;

use OpenCompany\Integrations\ZohoInventory\ZohoInventoryService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List packages from Zoho Inventory.
 *
 * Supports pagination.
 */
class ZohoInventoryListPackages implements Tool
{
    public function __construct(
        private ZohoInventoryService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_inventory_list_packages';
    }

    public function description(): string
    {
        return 'List packages from Zoho Inventory. Supports pagination to browse through package records.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of packages per page, max 200 (default: 25).'],
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

            $result = $this->service->listPackages($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
