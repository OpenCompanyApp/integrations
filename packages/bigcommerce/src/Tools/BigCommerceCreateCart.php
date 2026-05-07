<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Create a cart.
 */
class BigCommerceCreateCart extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_create_cart';

    protected string $toolDescription = 'Create a cart.';

    protected string $method = 'POST';

    protected string $path = '/v3/carts';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Cart fields, including line_items.',
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