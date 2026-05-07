<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * Create a project event data request for privacy workflows.
 */
class BugsnagCreateProjectEventDataRequest extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'project_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag project ID.',
    'required' => true,
  ),
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Event data request body.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'description' => 'Filters and report_type parameters.',
  ),
);

    protected array $required = array (
  0 => 'project_id',
);

    protected array $queryParams = array (
  0 => 'query',
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'POST';

    protected string $path = '/projects/{project_id}/event_data_requests';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_create_project_event_data_request';

    protected string $toolDescription = 'Create a project event data request for privacy workflows.';
}
