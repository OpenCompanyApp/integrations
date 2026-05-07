<?php

namespace OpenCompany\Integrations\Etsy\Tools;

/**
 * Update an Etsy shop listing.
 */
class EtsyUpdateListing extends AbstractEtsyTool
{
    public const NAME = 'etsy_update_listing';
    public const DESCRIPTION = 'Update an Etsy listing in the configured shop.';
    public const PARAMETERS = [
        'listing_id' => ['type' => 'integer', 'required' => true, 'description' => 'Listing ID.'],
        'data' => ['type' => 'object', 'required' => true, 'description' => 'Listing update payload, such as title, description, price, quantity, state, or shipping_profile_id.'],
    ];

    /**
     * Update a listing.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->updateListing(
            $this->requiredInt($args, 'listing_id', 'listing_id'),
            $this->requiredArray($args, 'data', 'data')
        );
    }
}
