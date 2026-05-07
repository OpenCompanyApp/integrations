<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Export send analytics over a time range.
 */
class BrazeGetSendAnalytics extends AbstractBrazeTool
{
    protected array $parameters = array (
  'campaign_id' =>
  array (
    'type' => 'string',
    'description' => 'Campaign ID.',
    'required' => true,
  ),
  'send_id' =>
  array (
    'type' => 'string',
    'description' => 'Send ID.',
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
  0 => 'campaign_id',
  1 => 'send_id',
);

    protected array $queryParams = array (
  0 => 'campaign_id',
  1 => 'send_id',
  2 => 'length',
  3 => 'ending_at',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/sends/data_series';

    protected string $toolName = 'braze_get_send_analytics';

    protected string $toolDescription = 'Export send analytics over a time range.';
}