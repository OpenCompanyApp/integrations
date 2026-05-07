<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete an order.
 */
class BigCommerceDeleteOrder extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_order';

    protected string $toolDescription = 'Delete an order.';

    protected string $method = 'DELETE';

    protected string $path = '/v2/orders/{order_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'order_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce order ID.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'order_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}