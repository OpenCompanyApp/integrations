<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * Get one Bugsnag team.
 */
class BugsnagGetTeam extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag organization ID.',
    'required' => true,
  ),
  'team_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag team ID.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'organization_id',
  1 => 'team_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/organizations/{organization_id}/teams/{team_id}';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_get_team';

    protected string $toolDescription = 'Get one Bugsnag team.';
}
