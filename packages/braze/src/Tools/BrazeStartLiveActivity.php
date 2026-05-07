<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Start an iOS Live Activity.
 */
class BrazeStartLiveActivity extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Live Activity start payload.',
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

    protected string $path = '/messages/live_activity/start';

    protected string $toolName = 'braze_start_live_activity';

    protected string $toolDescription = 'Start an iOS Live Activity.';
}