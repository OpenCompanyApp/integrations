<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Update an iOS Live Activity.
 */
class BrazeUpdateLiveActivity extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Live Activity update payload.',
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

    protected string $path = '/messages/live_activity/update';

    protected string $toolName = 'braze_update_live_activity';

    protected string $toolDescription = 'Update an iOS Live Activity.';
}