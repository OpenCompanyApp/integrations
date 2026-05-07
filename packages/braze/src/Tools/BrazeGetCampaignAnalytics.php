<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Export campaign analytics over a time range.
 */
class BrazeGetCampaignAnalytics extends AbstractBrazeTool
{
    protected array $parameters = array (
  'campaign_id' =>
  array (
    'type' => 'string',
    'description' => 'Campaign ID.',
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
);

    protected array $queryParams = array (
  0 => 'campaign_id',
  1 => 'length',
  2 => 'ending_at',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/campaigns/data_series';

    protected string $toolName = 'braze_get_campaign_analytics';

    protected string $toolDescription = 'Export campaign analytics over a time range.';
}