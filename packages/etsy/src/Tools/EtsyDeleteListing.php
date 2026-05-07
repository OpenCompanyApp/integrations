<?php

namespace OpenCompany\Integrations\Etsy\Tools;

/**
 * Delete an Etsy listing.
 */
class EtsyDeleteListing extends AbstractEtsyTool
{
    public const NAME = 'etsy_delete_listing';
    public const DESCRIPTION = 'Delete an Etsy listing from the configured shop.';
    public const PARAMETERS = [
        'listing_id' => ['type' => 'integer', 'required' => true, 'description' => 'Listing ID.'],
    ];

    /**
     * Delete a listing.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function call(array $args): string
    {
        $listingId = $this->requiredInt($args, 'listing_id', 'listing_id');
        $this->service->deleteListing($listingId);

        return "Listing {$listingId} has been deleted.";
    }
}
