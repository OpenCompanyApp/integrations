<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one cart.
 */
class BigCommerceGetCart extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_cart';

    protected string $toolDescription = 'Get one cart.';

    protected string $method = 'GET';

    protected string $path = '/v3/carts/{cart_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'cart_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Cart ID.',
  ),
  'include' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Related resources to include.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'cart_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
  0 => 'include',
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}