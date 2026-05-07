<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Create checkout consignments.
 */
class BigCommerceCreateCheckoutConsignments extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_create_checkout_consignments';

    protected string $toolDescription = 'Create checkout consignments.';

    protected string $method = 'POST';

    protected string $path = '/v3/checkouts/{checkout_id}/consignments';

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
    'description' => 'Array of consignment fields.',
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