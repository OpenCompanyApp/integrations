<?php

namespace OpenCompany\Integrations\Etsy\Tools;

/**
 * List sections for the configured Etsy shop.
 */
class EtsyListShopSections extends AbstractEtsyTool
{
    public const NAME = 'etsy_list_shop_sections';
    public const DESCRIPTION = 'List sections for the configured Etsy shop.';
    public const PARAMETERS = [];

    /**
     * List shop sections.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listShopSections();
    }
}
