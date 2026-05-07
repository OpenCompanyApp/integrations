<?php

namespace OpenCompany\Integrations\Etsy\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Etsy\EtsyService;

/**
 * Get the inventory for a specific Etsy listing.
 */
class EtsyGetListingInventory implements Tool
{
    /**
     * @param  EtsyService  $service  The Etsy Open API client.
     */
    public function __construct(
        private EtsyService $service,
    ) {}

    public function name(): string
    {
        return 'etsy_get_listing_inventory';
    }

    public function description(): string
    {
        return 'Get the inventory (products, offerings, and pricing) for a specific Etsy listing.';
    }

    public function parameters(): array
    {
        return [
            'listing_id' => [
                'type' => 'integer',
                'required' => true,
                'description' => 'The Etsy listing ID.',
            ],
        ];
    }

    /**
     * Get products, offerings, and inventory data for one listing.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Etsy integration is not configured.');
            }

            $listingId = $args['listing_id'] ?? null;
            if (empty($listingId)) {
                return ToolResult::error('Listing ID is required.');
            }

            $result = $this->service->getListingInventory((int) $listingId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
