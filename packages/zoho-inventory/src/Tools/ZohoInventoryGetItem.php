<?php

namespace OpenCompany\Integrations\ZohoInventory\Tools;

use OpenCompany\Integrations\ZohoInventory\ZohoInventoryService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single inventory item by ID from Zoho Inventory.
 */
class ZohoInventoryGetItem implements Tool
{
    public function __construct(
        private ZohoInventoryService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_inventory_get_item';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific inventory item (product) by its Zoho Inventory ID.';
    }

    public function parameters(): array
    {
        return [
            'item_id' => ['type' => 'string', 'required' => true, 'description' => 'The Zoho Inventory item ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Inventory integration is not configured.');
            }

            if (empty($args['item_id'])) {
                return ToolResult::error('item_id is required.');
            }

            $result = $this->service->getItem($args['item_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
