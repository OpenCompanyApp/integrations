<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Delete a Braze catalog item.
 */
class BrazeDeleteCatalogItem extends AbstractBrazeTool
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

    protected string $method = 'DELETE';

    protected string $path = '/catalogs/{catalog_name}/items/{item_id}';

    protected string $toolName = 'braze_delete_catalog_item';

    protected string $toolDescription = 'Delete a Braze catalog item.';
}