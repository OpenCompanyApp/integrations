<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Export custom event analytics.
 */
class BrazeGetEventAnalytics extends AbstractBrazeTool
{
    protected array $parameters = array (
  'event' =>
  array (
    'type' => 'string',
    'description' => 'Custom event name.',
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
  0 => 'event',
);

    protected array $queryParams = array (
  0 => 'event',
  1 => 'length',
  2 => 'ending_at',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/events/data_series';

    protected string $toolName = 'braze_get_event_analytics';

    protected string $toolDescription = 'Export custom event analytics.';
}