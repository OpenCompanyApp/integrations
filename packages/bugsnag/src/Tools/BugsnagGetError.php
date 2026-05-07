<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * Get details for a Bugsnag error.
 */
class BugsnagGetError extends AbstractBugsnagTool
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

    protected string $method = 'GET';

    protected string $path = '/errors/{error_id}';

    protected string $api = 'data';

    protected string $toolName = 'bugsnag_get_error';

    protected string $toolDescription = 'Get details for a Bugsnag error.';
}
