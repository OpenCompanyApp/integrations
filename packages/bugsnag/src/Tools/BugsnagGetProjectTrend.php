<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * Get time-series trend data for a Bugsnag project.
 */
class BugsnagGetProjectTrend extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'project_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag project ID.',
    'required' => true,
  ),
  'resolution' =>
  array (
    'type' => 'string',
    'description' => 'Trend bucket size such as 30m.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'description' => 'Filters and additional trend parameters.',
  ),
);

    protected array $required = array (
  0 => 'project_id',
);

    protected array $queryParams = array (
  0 => 'resolution',
  1 => 'query',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/projects/{project_id}/trend';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_get_project_trend';

    protected string $toolDescription = 'Get time-series trend data for a Bugsnag project.';
}
