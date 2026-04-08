<?php

namespace OpenCompany\Integrations\ZohoInventory\Tools;

use OpenCompany\Integrations\ZohoInventory\ZohoInventoryService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single sales order by ID from Zoho Inventory.
 */
class ZohoInventoryGetOrder implements Tool
{
    public function __construct(
        private ZohoInventoryService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_inventory_get_order';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific sales order by its Zoho Inventory ID.';
    }

    public function parameters(): array
    {
        return [
            'order_id' => ['type' => 'string', 'required' => true, 'description' => 'The Zoho Inventory sales order ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Inventory integration is not configured.');
            }

            if (empty($args['order_id'])) {
                return ToolResult::error('order_id is required.');
            }

            $result = $this->service->getOrder($args['order_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
