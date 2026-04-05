<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Set the available inventory level for a Shopify item at a location.
 */
class ShopifyUpdateInventoryLevel implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_update_inventory_level';
    }

    public function description(): string
    {
        return <<<'MD'
        Set the available inventory level for a specific item at a specific location.
        Requires inventory_item_id, location_id, and the new available quantity.
        Use shopify_list_locations to find location IDs and shopify_list_inventory_items for item IDs.
        MD;
    }

    public function parameters(): array
    {
        return [
            'inventory_item_id' => ['type' => 'string', 'description' => 'The inventory item ID.'],
            'location_id' => ['type' => 'string', 'description' => 'The location ID where inventory is held.'],
            'available' => ['type' => 'integer', 'description' => 'The new available quantity.'],
        ];
    }

    /**
     * Update an inventory level in Shopify.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Shopify integration is not configured.');
            }

            $itemId = $args['inventory_item_id'] ?? '';
            $locationId = $args['location_id'] ?? '';

            if (empty($itemId)) {
                return ToolResult::error('inventory_item_id is required.');
            }
            if (empty($locationId)) {
                return ToolResult::error('location_id is required.');
            }
            if (! isset($args['available'])) {
                return ToolResult::error('available quantity is required.');
            }

            $result = $this->service->setInventoryLevel([
                'inventory_item_id' => $itemId,
                'location_id' => $locationId,
                'available' => (int) $args['available'],
            ]);

            $level = $result['inventory_level'] ?? $result;

            return ToolResult::success([
                'inventory_item_id' => $level['inventory_item_id'] ?? $itemId,
                'location_id' => $level['location_id'] ?? $locationId,
                'available' => $level['available'] ?? (int) $args['available'],
                'updated_at' => $level['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
