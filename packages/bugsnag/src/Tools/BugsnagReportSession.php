<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * Report a session to the Bugsnag Session Tracking API.
 */
class BugsnagReportSession extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Session Tracking API payload.',
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

    protected string $api = 'sessions';

    protected string $toolName = 'bugsnag_report_session';

    protected string $toolDescription = 'Report a session to the Bugsnag Session Tracking API.';
}
