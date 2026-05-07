<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * List store orders with BigCommerce v2 filters.
 */
class BigCommerceListOrders extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_list_orders';

    protected string $toolDescription = 'List store orders with BigCommerce v2 filters.';

    protected string $method = 'GET';

    protected string $path = '/v2/orders';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Maximum number of records to return.',
  ),
  'page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Page number for paginated endpoints.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional documented BigCommerce query parameters to pass through.',
  ),
  'status_id' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Order status ID.',
  ),
  'customer_id' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Customer ID.',
  ),
  'min_date_created' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Minimum created date.',
  ),
  'max_date_created' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Maximum created date.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
  0 => 'limit',
  1 => 'page',
  2 => 'status_id',
  3 => 'customer_id',
  4 => 'min_date_created',
  5 => 'max_date_created',
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}