<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Shopify locations.
 */
class ShopifyListLocations implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_list_locations';
    }

    public function description(): string
    {
        return <<<'MD'
        List all Shopify locations (fulfillment locations / warehouses).
        Returns location IDs, names, and addresses needed for inventory management.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List all locations from Shopify.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Shopify integration is not configured.');
            }

            $result = $this->service->listLocations();
            $locations = $result['locations'] ?? [];

            return ToolResult::success([
                'locations' => $locations,
                'count' => count($locations),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
