<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete a cart.
 */
class BigCommerceDeleteCart extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_cart';

    protected string $toolDescription = 'Delete a cart.';

    protected string $method = 'DELETE';

    protected string $path = '/v3/carts/{cart_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'cart_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Cart ID.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'cart_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}