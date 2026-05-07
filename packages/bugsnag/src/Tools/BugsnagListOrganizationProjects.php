<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * List projects for a Bugsnag organization.
 */
class BugsnagListOrganizationProjects extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag organization ID.',
    'required' => true,
  ),
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
  0 => 'organization_id',
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

    protected string $path = '/organizations/{organization_id}/projects';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_list_organization_projects';

    protected string $toolDescription = 'List projects for a Bugsnag organization.';
}
