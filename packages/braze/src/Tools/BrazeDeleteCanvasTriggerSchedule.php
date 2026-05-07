<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Delete a scheduled API-triggered Canvas.
 */
class BrazeDeleteCanvasTriggerSchedule extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Canvas trigger schedule delete payload.',
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

    protected string $path = '/canvas/trigger/schedule/delete';

    protected string $toolName = 'braze_delete_canvas_trigger_schedule';

    protected string $toolDescription = 'Delete a scheduled API-triggered Canvas.';
}