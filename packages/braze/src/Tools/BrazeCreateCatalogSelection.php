<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Create a Braze catalog selection.
 */
class BrazeCreateCatalogSelection extends AbstractBrazeTool
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
    'description' => 'Selection payload.',
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

    protected string $path = '/catalogs/{catalog_name}/selections';

    protected string $toolName = 'braze_create_catalog_selection';

    protected string $toolDescription = 'Create a Braze catalog selection.';
}