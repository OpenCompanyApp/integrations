<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Trigger an API-triggered Braze Canvas.
 */
class BrazeTriggerCanvasSend extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Canvas trigger payload.',
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

    protected string $path = '/canvas/trigger/send';

    protected string $toolName = 'braze_trigger_canvas_send';

    protected string $toolDescription = 'Trigger an API-triggered Braze Canvas.';
}