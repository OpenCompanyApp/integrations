<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * List Bugsnag projects visible to the authenticated user.
 */
class BugsnagListProjects extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'q' =>
  array (
    'type' => 'string',
    'description' => 'Search query.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'description' => 'Sort field.',
  ),
  'direction' =>
  array (
    'type' => 'string',
    'description' => 'Sort direction.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'description' => 'Additional query parameters.',
  ),
);

    protected array $required = array (
);

    protected array $queryParams = array (
  0 => 'q',
  1 => 'sort',
  2 => 'direction',
  3 => 'query',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/projects';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_list_projects';

    protected string $toolDescription = 'List Bugsnag projects visible to the authenticated user.';
}
