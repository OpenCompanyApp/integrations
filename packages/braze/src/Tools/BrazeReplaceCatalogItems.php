<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Replace multiple Braze catalog items asynchronously.
 */
class BrazeReplaceCatalogItems extends AbstractBrazeTool
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
    'description' => 'Bulk catalog items payload.',
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

    protected string $method = 'PUT';

    protected string $path = '/catalogs/{catalog_name}/items';

    protected string $toolName = 'braze_replace_catalog_items';

    protected string $toolDescription = 'Replace multiple Braze catalog items asynchronously.';
}