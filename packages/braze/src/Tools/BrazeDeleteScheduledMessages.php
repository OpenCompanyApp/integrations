<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Delete scheduled messages.
 */
class BrazeDeleteScheduledMessages extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Scheduled message delete payload.',
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

    protected string $path = '/messages/schedule/delete';

    protected string $toolName = 'braze_delete_scheduled_messages';

    protected string $toolDescription = 'Delete scheduled messages.';
}