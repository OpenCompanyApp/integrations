<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update an order.
 */
class BigCommerceUpdateOrder extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_order';

    protected string $toolDescription = 'Update an order.';

    protected string $method = 'PUT';

    protected string $path = '/v2/orders/{order_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'order_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce order ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Order fields to update.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'order_id',
  1 => 'payload',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
  0 => 'payload',
);
}