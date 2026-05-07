<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Edit a Braze catalog item.
 */
class BrazeEditCatalogItem extends AbstractBrazeTool
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
    'description' => 'Catalog item patch body.',
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

    protected string $method = 'PATCH';

    protected string $path = '/catalogs/{catalog_name}/items/{item_id}';

    protected string $toolName = 'braze_edit_catalog_item';

    protected string $toolDescription = 'Edit a Braze catalog item.';
}