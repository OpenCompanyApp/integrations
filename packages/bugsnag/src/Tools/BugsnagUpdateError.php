<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * Update a Bugsnag error status or assignment.
 */
class BugsnagUpdateError extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'error_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag error ID.',
    'required' => true,
  ),
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Error update payload.',
  ),
);

    protected array $required = array (
  0 => 'error_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'PATCH';

    protected string $path = '/errors/{error_id}';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_update_error';

    protected string $toolDescription = 'Update a Bugsnag error status or assignment.';
}
