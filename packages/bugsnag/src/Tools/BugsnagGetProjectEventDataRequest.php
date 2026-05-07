<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * Get project event data request status.
 */
class BugsnagGetProjectEventDataRequest extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'project_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag project ID.',
    'required' => true,
  ),
  'request_id' =>
  array (
    'type' => 'string',
    'description' => 'Event data request ID.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'project_id',
  1 => 'request_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/projects/{project_id}/event_data_requests/{request_id}';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_get_project_event_data_request';

    protected string $toolDescription = 'Get project event data request status.';
}
