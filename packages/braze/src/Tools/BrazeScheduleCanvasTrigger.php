<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Schedule an API-triggered Canvas.
 */
class BrazeScheduleCanvasTrigger extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Canvas trigger schedule payload.',
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

    protected string $path = '/canvas/trigger/schedule/create';

    protected string $toolName = 'braze_schedule_canvas_trigger';

    protected string $toolDescription = 'Schedule an API-triggered Canvas.';
}