<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

/**
 * Notify Bugsnag of a build or release.
 */
class BugsnagNotifyBuild extends AbstractBugsnagTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Build API payload.',
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

    protected string $api = 'build';

    protected string $toolName = 'bugsnag_notify_build';

    protected string $toolDescription = 'Notify Bugsnag of a build or release.';
}
