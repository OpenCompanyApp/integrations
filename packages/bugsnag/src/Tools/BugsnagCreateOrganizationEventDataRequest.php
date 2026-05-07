<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * Create an organization-wide event data request for privacy workflows.
 */
class BugsnagCreateOrganizationEventDataRequest extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag organization ID.',
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
  0 => 'organization_id',
);

    protected array $queryParams = array (
  0 => 'query',
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'POST';

    protected string $path = '/organizations/{organization_id}/event_data_requests';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_create_organization_event_data_request';

    protected string $toolDescription = 'Create an organization-wide event data request for privacy workflows.';
}
