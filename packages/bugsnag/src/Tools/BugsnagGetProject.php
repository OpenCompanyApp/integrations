<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * Get details for a Bugsnag project.
 */
class BugsnagGetProject extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'project_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag project ID.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'project_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/projects/{project_id}';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_get_project';

    protected string $toolDescription = 'Get details for a Bugsnag project.';
}
