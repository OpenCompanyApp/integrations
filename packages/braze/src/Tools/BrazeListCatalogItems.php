<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * List items in a Braze catalog.
 */
class BrazeListCatalogItems extends AbstractBrazeTool
{
    protected array $parameters = array (
  'catalog_name' =>
  array (
    'type' => 'string',
    'description' => 'Catalog name.',
    'required' => true,
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'Maximum number of items.',
  ),
  'offset' =>
  array (
    'type' => 'integer',
    'description' => 'Pagination offset.',
  ),
);

    protected array $required = array (
  0 => 'catalog_name',
);

    protected array $queryParams = array (
  0 => 'limit',
  1 => 'offset',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/catalogs/{catalog_name}/items';

    protected string $toolName = 'braze_list_catalog_items';

    protected string $toolDescription = 'List items in a Braze catalog.';
}