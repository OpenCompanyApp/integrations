<?php

namespace OpenCompany\Integrations\Etsy\Tools;

/**
 * Update inventory for an Etsy listing.
 */
class EtsyUpdateListingInventory extends AbstractEtsyTool
{
    public const NAME = 'etsy_update_listing_inventory';
    public const DESCRIPTION = 'Update products, offerings, SKUs, prices, and quantities for an Etsy listing.';
    public const PARAMETERS = [
        'listing_id' => ['type' => 'integer', 'required' => true, 'description' => 'Listing ID.'],
        'data' => ['type' => 'object', 'required' => true, 'description' => 'Inventory payload with products and optional price_on_property, quantity_on_property, sku_on_property.'],
    ];

    /**
     * Update listing inventory.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->updateListingInventory(
            $this->requiredInt($args, 'listing_id', 'listing_id'),
            $this->requiredArray($args, 'data', 'data')
        );
    }
}
