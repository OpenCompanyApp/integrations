<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Delete a Braze catalog field.
 */
class BrazeDeleteCatalogField extends AbstractBrazeTool
{
    protected array $parameters = array (
  'catalog_name' =>
  array (
    'type' => 'string',
    'description' => 'Catalog name.',
    'required' => true,
  ),
  'field_name' =>
  array (
    'type' => 'string',
    'description' => 'Field name.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'catalog_name',
  1 => 'field_name',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'DELETE';

    protected string $path = '/catalogs/{catalog_name}/fields/{field_name}';

    protected string $toolName = 'braze_delete_catalog_field';

    protected string $toolDescription = 'Delete a Braze catalog field.';
}