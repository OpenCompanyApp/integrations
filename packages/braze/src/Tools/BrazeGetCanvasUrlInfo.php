<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Get URL details for a Canvas step message variation.
 */
class BrazeGetCanvasUrlInfo extends AbstractBrazeTool
{
    protected array $parameters = array (
  'canvas_id' =>
  array (
    'type' => 'string',
    'description' => 'Canvas ID.',
    'required' => true,
  ),
  'canvas_step_id' =>
  array (
    'type' => 'string',
    'description' => 'Canvas step ID.',
  ),
  'message_variation_id' =>
  array (
    'type' => 'string',
    'description' => 'Message variation ID.',
  ),
);

    protected array $required = array (
  0 => 'canvas_id',
);

    protected array $queryParams = array (
  0 => 'canvas_id',
  1 => 'canvas_step_id',
  2 => 'message_variation_id',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/canvas/url_info/details';

    protected string $toolName = 'braze_get_canvas_url_info';

    protected string $toolDescription = 'Get URL details for a Canvas step message variation.';
}