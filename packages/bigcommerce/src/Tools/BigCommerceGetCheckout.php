<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get checkout details.
 */
class BigCommerceGetCheckout extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_checkout';

    protected string $toolDescription = 'Get checkout details.';

    protected string $method = 'GET';

    protected string $path = '/v3/checkouts/{checkout_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'checkout_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Checkout ID.',
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
  0 => 'checkout_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
  0 => 'include',
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}