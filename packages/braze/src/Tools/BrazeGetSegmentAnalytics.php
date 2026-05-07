<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Export segment analytics.
 */
class BrazeGetSegmentAnalytics extends AbstractBrazeTool
{
    protected array $parameters = array (
  'segment_id' =>
  array (
    'type' => 'string',
    'description' => 'Segment ID.',
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
  0 => 'segment_id',
);

    protected array $queryParams = array (
  0 => 'segment_id',
  1 => 'length',
  2 => 'ending_at',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/segments/data_series';

    protected string $toolName = 'braze_get_segment_analytics';

    protected string $toolDescription = 'Export segment analytics.';
}