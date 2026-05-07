<?php

namespace OpenCompany\Integrations\Etsy\Tools;

/**
 * List shipping profiles for the configured Etsy shop.
 */
class EtsyListShippingProfiles extends AbstractEtsyTool
{
    public const NAME = 'etsy_list_shipping_profiles';
    public const DESCRIPTION = 'List shipping profiles for the configured Etsy shop.';
    public const PARAMETERS = [];

    /**
     * List shipping profiles.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listShippingProfiles();
    }
}
