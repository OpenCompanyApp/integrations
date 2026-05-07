<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Create scheduled messages.
 */
class BrazeCreateScheduledMessages extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Scheduled message payload.',
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

    protected string $path = '/messages/schedule/create';

    protected string $toolName = 'braze_create_scheduled_messages';

    protected string $toolDescription = 'Create scheduled messages.';
}