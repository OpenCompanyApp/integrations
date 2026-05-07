<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * List Order Transactions for an order.
 */
class BigCommerceListTransactions extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_list_transactions';

    protected string $toolDescription = 'List Order Transactions for an order.';

    protected string $method = 'GET';

    protected string $path = '/v3/orders/{order_id}/transactions';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'order_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce order ID.',
  ),
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
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'order_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
  0 => 'limit',
  1 => 'page',
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}