<?php

namespace OpenCompany\Integrations\Etsy\Tools;

/**
 * List images for an Etsy listing.
 */
class EtsyListListingImages extends AbstractEtsyTool
{
    public const NAME = 'etsy_list_listing_images';
    public const DESCRIPTION = 'List images attached to an Etsy listing.';
    public const PARAMETERS = [
        'listing_id' => ['type' => 'integer', 'required' => true, 'description' => 'Listing ID.'],
    ];

    /**
     * List listing images.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listListingImages($this->requiredInt($args, 'listing_id', 'listing_id'));
    }
}
