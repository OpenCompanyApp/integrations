<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Create an order.
 */
class BigCommerceCreateOrder extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_create_order';

    protected string $toolDescription = 'Create an order.';

    protected string $method = 'POST';

    protected string $path = '/v2/orders';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Order fields accepted by BigCommerce v2 Orders.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'payload',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
  0 => 'payload',
);
}