<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * Get a Bugsnag project release.
 */
class BugsnagGetProjectRelease extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'project_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag project ID.',
    'required' => true,
  ),
  'release_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag release ID.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'project_id',
  1 => 'release_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/projects/{project_id}/releases/{release_id}';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_get_project_release';

    protected string $toolDescription = 'Get a Bugsnag project release.';
}
