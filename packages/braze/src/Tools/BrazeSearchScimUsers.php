<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Search Braze dashboard SCIM users.
 */
class BrazeSearchScimUsers extends AbstractBrazeTool
{
    protected array $parameters = array (
  'filter' =>
  array (
    'type' => 'string',
    'description' => 'SCIM filter expression.',
  ),
  'startIndex' =>
  array (
    'type' => 'integer',
    'description' => 'SCIM start index.',
  ),
  'count' =>
  array (
    'type' => 'integer',
    'description' => 'Maximum records.',
  ),
);

    protected array $required = array (
);

    protected array $queryParams = array (
  0 => 'filter',
  1 => 'startIndex',
  2 => 'count',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/scim/v2/Users';

    protected string $toolName = 'braze_search_scim_users';

    protected string $toolDescription = 'Search Braze dashboard SCIM users.';
}