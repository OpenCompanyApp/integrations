<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * List collaborators for a Bugsnag organization.
 */
class BugsnagListCollaborators extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag organization ID.',
    'required' => true,
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
  0 => 'query',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/organizations/{organization_id}/collaborators';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_list_collaborators';

    protected string $toolDescription = 'List collaborators for a Bugsnag organization.';
}
