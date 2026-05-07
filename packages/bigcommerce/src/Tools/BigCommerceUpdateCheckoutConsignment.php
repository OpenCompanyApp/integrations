<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update a checkout consignment.
 */
class BigCommerceUpdateCheckoutConsignment extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_checkout_consignment';

    protected string $toolDescription = 'Update a checkout consignment.';

    protected string $method = 'PUT';

    protected string $path = '/v3/checkouts/{checkout_id}/consignments/{consignment_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'checkout_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Checkout ID.',
  ),
  'consignment_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Consignment ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Consignment fields to update.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'checkout_id',
  1 => 'consignment_id',
  2 => 'payload',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
  0 => 'payload',
);
}