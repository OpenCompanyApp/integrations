<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * Delete a Bugsnag error.
 */
class BugsnagDeleteError extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'error_id' =>
  array (
    'type' => 'string',
    'description' => 'Bugsnag error ID.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'error_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'DELETE';

    protected string $path = '/errors/{error_id}';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_delete_error';

    protected string $toolDescription = 'Delete a Bugsnag error.';
}
