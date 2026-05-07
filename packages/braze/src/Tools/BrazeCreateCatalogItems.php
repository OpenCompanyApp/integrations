<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Create multiple Braze catalog items asynchronously.
 */
class BrazeCreateCatalogItems extends AbstractBrazeTool
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

    protected string $method = 'POST';

    protected string $path = '/catalogs/{catalog_name}/items';

    protected string $toolName = 'braze_create_catalog_items';

    protected string $toolDescription = 'Create multiple Braze catalog items asynchronously.';
}