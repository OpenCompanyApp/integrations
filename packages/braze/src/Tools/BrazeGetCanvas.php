<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Get Braze Canvas details.
 */
class BrazeGetCanvas extends AbstractBrazeTool
{
    protected array $parameters = array (
  'canvas_id' =>
  array (
    'type' => 'string',
    'description' => 'Canvas ID.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'canvas_id',
);

    protected array $queryParams = array (
  0 => 'canvas_id',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/canvas/details';

    protected string $toolName = 'braze_get_canvas';

    protected string $toolDescription = 'Get Braze Canvas details.';
}