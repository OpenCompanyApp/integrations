<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update checkout billing address.
 */
class BigCommerceUpdateCheckoutBillingAddress extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_checkout_billing_address';

    protected string $toolDescription = 'Update checkout billing address.';

    protected string $method = 'PUT';

    protected string $path = '/v3/checkouts/{checkout_id}/billing-address';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'checkout_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Checkout ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Billing address fields.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'checkout_id',
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