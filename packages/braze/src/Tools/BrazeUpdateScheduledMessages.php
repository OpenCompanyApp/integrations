<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Update scheduled messages.
 */
class BrazeUpdateScheduledMessages extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Scheduled message update payload.',
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

    protected string $path = '/messages/schedule/update';

    protected string $toolName = 'braze_update_scheduled_messages';

    protected string $toolDescription = 'Update scheduled messages.';
}