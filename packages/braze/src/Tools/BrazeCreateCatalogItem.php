<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Create a Braze catalog item.
 */
class BrazeCreateCatalogItem extends AbstractBrazeTool
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
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Catalog item body.',
  ),
);

    protected array $required = array (
  0 => 'catalog_name',
  1 => 'item_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'POST';

    protected string $path = '/catalogs/{catalog_name}/items/{item_id}';

    protected string $toolName = 'braze_create_catalog_item';

    protected string $toolDescription = 'Create a Braze catalog item.';
}