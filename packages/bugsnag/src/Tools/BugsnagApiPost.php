<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * Call any Bugsnag Data Access API POST endpoint with a JSON payload.
 */
class BugsnagApiPost extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'path' =>
  array (
    'type' => 'string',
    'description' => 'Endpoint path relative to the Bugsnag Data Access API base URL.',
    'required' => true,
  ),
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body.',
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
  0 => 'payload',
);

    protected string $method = 'POST';

    protected string $path = '/{path}';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_api_post';

    protected string $toolDescription = 'Call any Bugsnag Data Access API POST endpoint with a JSON payload.';
}
