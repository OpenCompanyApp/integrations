<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete a checkout consignment.
 */
class BigCommerceDeleteCheckoutConsignment extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_checkout_consignment';

    protected string $toolDescription = 'Delete a checkout consignment.';

    protected string $method = 'DELETE';

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
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'checkout_id',
  1 => 'consignment_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}