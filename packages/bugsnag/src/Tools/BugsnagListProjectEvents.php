<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * List events for a Bugsnag project.
 */
class BugsnagListProjectEvents extends AbstractBugsnagTool
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
    'description' => 'Filters and pagination parameters.',
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

    protected string $path = '/projects/{project_id}/events';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_list_project_events';

    protected string $toolDescription = 'List events for a Bugsnag project.';
}
