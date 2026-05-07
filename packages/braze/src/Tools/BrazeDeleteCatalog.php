<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Delete a Braze catalog.
 */
class BrazeDeleteCatalog extends AbstractBrazeTool
{
    protected array $parameters = array (
  'catalog_name' =>
  array (
    'type' => 'string',
    'description' => 'Catalog name.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'catalog_name',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'DELETE';

    protected string $path = '/catalogs/{catalog_name}';

    protected string $toolName = 'braze_delete_catalog';

    protected string $toolDescription = 'Delete a Braze catalog.';
}