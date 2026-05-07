<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * List Bugsnag pivot values for an error.
 */
class BugsnagListPivotValues extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'project_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag project ID.',
    'required' => true,
  ),
  'error_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag error ID.',
    'required' => true,
  ),
  'pivot' =>
  array (
    'type' => 'string',
    'description' => 'Event field display ID such as user.id.',
    'required' => true,
  ),
  'query' =>
  array (
    'type' => 'object',
    'description' => 'Filters and pagination parameters.',
  ),
);

    protected array $required = array (
  0 => 'project_id',
  1 => 'error_id',
  2 => 'pivot',
);

    protected array $queryParams = array (
  0 => 'query',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/projects/{project_id}/errors/{error_id}/pivots/{pivot}/values';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_list_pivot_values';

    protected string $toolDescription = 'List Bugsnag pivot values for an error.';
}
