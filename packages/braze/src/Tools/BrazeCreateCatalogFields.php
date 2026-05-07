<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Create Braze catalog fields.
 */
class BrazeCreateCatalogFields extends AbstractBrazeTool
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
    'description' => 'Catalog fields payload.',
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

    protected string $path = '/catalogs/{catalog_name}/fields';

    protected string $toolName = 'braze_create_catalog_fields';

    protected string $toolDescription = 'Create Braze catalog fields.';
}