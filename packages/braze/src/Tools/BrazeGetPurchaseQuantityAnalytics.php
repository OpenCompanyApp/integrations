<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Export number of purchases.
 */
class BrazeGetPurchaseQuantityAnalytics extends AbstractBrazeTool
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

    protected string $path = '/purchases/quantity_series';

    protected string $toolName = 'braze_get_purchase_quantity_analytics';

    protected string $toolDescription = 'Export number of purchases.';
}