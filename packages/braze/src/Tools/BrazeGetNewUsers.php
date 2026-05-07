<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Export daily new users.
 */
class BrazeGetNewUsers extends AbstractBrazeTool
{
    protected array $parameters = array (
  'app_id' =>
  array (
    'type' => 'string',
    'description' => 'App identifier.',
  ),
  'length' =>
  array (
    'type' => 'integer',
    'description' => 'Number of days.',
  ),
  'ending_at' =>
  array (
    'type' => 'string',
    'description' => 'End timestamp.',
  ),
);

    protected array $required = array (
);

    protected array $queryParams = array (
  0 => 'app_id',
  1 => 'length',
  2 => 'ending_at',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/kpi/new_users/data_series';

    protected string $toolName = 'braze_get_new_users';

    protected string $toolDescription = 'Export daily new users.';
}