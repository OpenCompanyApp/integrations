<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update Customer Addresses.
 */
class BigCommerceUpdateCustomerAddresses extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_customer_addresses';

    protected string $toolDescription = 'Update Customer Addresses.';

    protected string $method = 'PUT';

    protected string $path = '/v3/customers/addresses';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Array of Customer Addresses records with IDs.',
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