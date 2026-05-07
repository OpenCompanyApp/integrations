<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Export revenue data.
 */
class BrazeGetRevenueAnalytics extends AbstractBrazeTool
{
    protected array $parameters = array (
  'product' =>
  array (
    'type' => 'string',
    'description' => 'Product ID.',
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
);

    protected array $queryParams = array (
  0 => 'product',
  1 => 'length',
  2 => 'ending_at',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/purchases/revenue_series';

    protected string $toolName = 'braze_get_revenue_analytics';

    protected string $toolDescription = 'Export revenue data.';
}