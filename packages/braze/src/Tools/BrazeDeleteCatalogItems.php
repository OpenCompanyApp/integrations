<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Delete multiple Braze catalog items asynchronously.
 */
class BrazeDeleteCatalogItems extends AbstractBrazeTool
{
    protected array $parameters = array (
  'catalog_name' =>
  array (
    'type' => 'string',
    'description' => 'Catalog name.',
    'required' => true,
  ),
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Bulk delete payload.',
  ),
);

    protected array $required = array (
  0 => 'catalog_name',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'DELETE';

    protected string $path = '/catalogs/{catalog_name}/items';

    protected string $toolName = 'braze_delete_catalog_items';

    protected string $toolDescription = 'Delete multiple Braze catalog items asynchronously.';
}