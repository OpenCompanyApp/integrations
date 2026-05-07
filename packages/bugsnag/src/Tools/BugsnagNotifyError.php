<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * Report an error event to the Bugsnag Error Reporting API.
 */
class BugsnagNotifyError extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Error Reporting API payload.',
  ),
);

    protected array $required = array (
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'POST';

    protected string $path = '/';

    protected string $api = 'notify';

    protected string $toolName = 'bugsnag_notify_error';

    protected string $toolDescription = 'Report an error event to the Bugsnag Error Reporting API.';
}
