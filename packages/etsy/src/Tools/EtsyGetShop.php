<?php

namespace OpenCompany\Integrations\Etsy\Tools;

/**
 * Get the configured Etsy shop.
 */
class EtsyGetShop extends AbstractEtsyTool
{
    public const NAME = 'etsy_get_shop';
    public const DESCRIPTION = 'Get the configured Etsy shop profile.';
    public const PARAMETERS = [];

    /**
     * Get the shop profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getShop();
    }
}
