<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * List Braze catalogs.
 */
class BrazeListCatalogs extends AbstractBrazeTool
{
    protected array $parameters = array (
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'Maximum number of catalogs to return.',
  ),
  'offset' =>
  array (
    'type' => 'integer',
    'description' => 'Pagination offset.',
  ),
);

    protected array $required = array (
);

    protected array $queryParams = array (
  0 => 'limit',
  1 => 'offset',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/catalogs';

    protected string $toolName = 'braze_list_catalogs';

    protected string $toolDescription = 'List Braze catalogs.';
}