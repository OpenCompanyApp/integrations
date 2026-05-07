<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * Call any Bugsnag Data Access API DELETE endpoint with query parameters.
 */
class BugsnagApiDelete extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'path' =>
  array (
    'type' => 'string',
    'description' => 'Endpoint path relative to the Bugsnag Data Access API base URL.',
    'required' => true,
  ),
  'query' =>
  array (
    'type' => 'object',
    'description' => 'Additional query parameters.',
  ),
);

    protected array $required = array (
  0 => 'path',
);

    protected array $queryParams = array (
  0 => 'query',
);

    protected array $bodyParams = array (
);

    protected string $method = 'DELETE';

    protected string $path = '/{path}';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_api_delete';

    protected string $toolDescription = 'Call any Bugsnag Data Access API DELETE endpoint with query parameters.';
}
