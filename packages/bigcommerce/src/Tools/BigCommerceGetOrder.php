<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one order by ID.
 */
class BigCommerceGetOrder extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_order';

    protected string $toolDescription = 'Get one order by ID.';

    protected string $method = 'GET';

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