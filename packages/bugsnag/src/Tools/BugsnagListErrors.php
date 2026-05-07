<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * List errors for a Bugsnag project.
 */
class BugsnagListErrors extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'project_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag project ID.',
    'required' => true,
  ),
  'query' =>
  array (
    'type' => 'object',
    'description' => 'Filters, sort, and pagination parameters.',
  ),
);

    protected array $required = array (
  0 => 'project_id',
);

    protected array $queryParams = array (
  0 => 'query',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/projects/{project_id}/errors';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_list_errors';

    protected string $toolDescription = 'List errors for a Bugsnag project.';
}
