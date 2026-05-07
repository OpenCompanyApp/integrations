<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * Get one Bugsnag collaborator.
 */
class BugsnagGetCollaborator extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag organization ID.',
    'required' => true,
  ),
  'collaborator_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag collaborator ID.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'organization_id',
  1 => 'collaborator_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/organizations/{organization_id}/collaborators/{collaborator_id}';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_get_collaborator';

    protected string $toolDescription = 'Get one Bugsnag collaborator.';
}
