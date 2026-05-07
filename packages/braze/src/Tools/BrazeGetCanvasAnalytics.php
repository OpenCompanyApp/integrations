<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Export Canvas analytics over a time range.
 */
class BrazeGetCanvasAnalytics extends AbstractBrazeTool
{
    protected array $parameters = array (
  'canvas_id' =>
  array (
    'type' => 'string',
    'description' => 'Canvas ID.',
    'required' => true,
  ),
  'length' =>
  array (
    'type' => 'integer',
    'description' => 'Number of days.',
  ),
  'ending_at' =>
  array (
    'type' => 'string',
    'description' => 'End timestamp.',
  ),
);

    protected array $required = array (
  0 => 'canvas_id',
);

    protected array $queryParams = array (
  0 => 'canvas_id',
  1 => 'length',
  2 => 'ending_at',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/canvas/data_series';

    protected string $toolName = 'braze_get_canvas_analytics';

    protected string $toolDescription = 'Export Canvas analytics over a time range.';
}