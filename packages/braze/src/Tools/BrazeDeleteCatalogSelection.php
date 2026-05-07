<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Delete a Braze catalog selection.
 */
class BrazeDeleteCatalogSelection extends AbstractBrazeTool
{
    protected array $parameters = array (
  'catalog_name' =>
  array (
    'type' => 'string',
    'description' => 'Catalog name.',
    'required' => true,
  ),
  'selection_name' =>
  array (
    'type' => 'string',
    'description' => 'Selection name.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'catalog_name',
  1 => 'selection_name',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'DELETE';

    protected string $path = '/catalogs/{catalog_name}/selections/{selection_name}';

    protected string $toolName = 'braze_delete_catalog_selection';

    protected string $toolDescription = 'Delete a Braze catalog selection.';
}