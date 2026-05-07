<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Export Canvas summary analytics.
 */
class BrazeGetCanvasSummary extends AbstractBrazeTool
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

    protected string $path = '/canvas/data_summary';

    protected string $toolName = 'braze_get_canvas_summary';

    protected string $toolDescription = 'Export Canvas summary analytics.';
}