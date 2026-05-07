<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * Get organization event data request status.
 */
class BugsnagGetOrganizationEventDataRequest extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag organization ID.',
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
  0 => 'organization_id',
  1 => 'request_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/organizations/{organization_id}/event_data_requests/{request_id}';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_get_organization_event_data_request';

    protected string $toolDescription = 'Get organization event data request status.';
}
