<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * List events for a specific Bugsnag error.
 */
class BugsnagListErrorEvents extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'error_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag error ID.',
    'required' => true,
  ),
  'query' =>
  array (
    'type' => 'object',
    'description' => 'Filters and pagination parameters.',
  ),
);

    protected array $required = array (
  0 => 'error_id',
);

    protected array $queryParams = array (
  0 => 'query',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/errors/{error_id}/events';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_list_error_events';

    protected string $toolDescription = 'List events for a specific Bugsnag error.';
}
