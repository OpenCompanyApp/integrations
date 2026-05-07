<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Get a single Braze catalog item.
 */
class BrazeGetCatalogItem extends AbstractBrazeTool
{
    protected array $parameters = array (
  'catalog_name' =>
  array (
    'type' => 'string',
    'description' => 'Catalog name.',
    'required' => true,
  ),
  'item_id' =>
  array (
    'type' => 'string',
    'description' => 'Catalog item ID.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'catalog_name',
  1 => 'item_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/catalogs/{catalog_name}/items/{item_id}';

    protected string $toolName = 'braze_get_catalog_item';

    protected string $toolDescription = 'Get a single Braze catalog item.';
}