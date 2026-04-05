<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Shopify inventory items.
 */
class ShopifyListInventoryItems implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_list_inventory_items';
    }

    public function description(): string
    {
        return <<<'MD'
        List Shopify inventory items.
        Supports filtering by specific item IDs and pagination.
        Use limit to control page size (max 250) and page_info for cursor-based pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of inventory items to return (max 250).'],
            'page_info' => ['type' => 'string', 'description' => 'Cursor for pagination (from previous response).'],
            'ids' => ['type' => 'string', 'description' => 'Comma-separated list of inventory item IDs to retrieve.'],
        ];
    }

    /**
     * List inventory items from Shopify.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Shopify integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['page_info'])) {
                $params['page_info'] = $args['page_info'];
            }
            if (isset($args['ids'])) {
                $params['ids'] = $args['ids'];
            }

            $result = $this->service->listInventoryItems($params);
            $items = $result['inventory_items'] ?? [];

            return ToolResult::success([
                'inventory_items' => $items,
                'count' => count($items),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
