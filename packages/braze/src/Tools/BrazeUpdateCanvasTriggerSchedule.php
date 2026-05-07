<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Update a scheduled API-triggered Canvas.
 */
class BrazeUpdateCanvasTriggerSchedule extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Canvas trigger schedule update payload.',
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

    protected string $path = '/canvas/trigger/schedule/update';

    protected string $toolName = 'braze_update_canvas_trigger_schedule';

    protected string $toolDescription = 'Update a scheduled API-triggered Canvas.';
}