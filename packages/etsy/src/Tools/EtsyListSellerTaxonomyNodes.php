<?php

namespace OpenCompany\Integrations\Etsy\Tools;

/**
 * List seller taxonomy nodes.
 */
class EtsyListSellerTaxonomyNodes extends AbstractEtsyTool
{
    public const NAME = 'etsy_list_seller_taxonomy_nodes';
    public const DESCRIPTION = 'List Etsy seller taxonomy nodes used for listing taxonomy_id values.';
    public const PARAMETERS = [];

    /**
     * List seller taxonomy nodes.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listSellerTaxonomyNodes();
    }
}
