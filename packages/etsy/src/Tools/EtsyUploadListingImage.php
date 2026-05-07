<?php

namespace OpenCompany\Integrations\Etsy\Tools;

/**
 * Upload an image to an Etsy listing.
 */
class EtsyUploadListingImage extends AbstractEtsyTool
{
    public const NAME = 'etsy_upload_listing_image';
    public const DESCRIPTION = 'Upload a local image file to an Etsy listing.';
    public const PARAMETERS = [
        'listing_id' => ['type' => 'integer', 'required' => true, 'description' => 'Listing ID.'],
        'image_path' => ['type' => 'string', 'required' => true, 'description' => 'Local image file path.'],
        'fields' => ['type' => 'object', 'description' => 'Optional multipart fields such as rank, overwrite, alt_text, and is_watermarked.'],
    ];

    /**
     * Upload a listing image.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->uploadListingImage(
            $this->requiredInt($args, 'listing_id', 'listing_id'),
            $this->requiredString($args, 'image_path', 'image_path'),
            $this->arrayArg($args, 'fields')
        );
    }
}
