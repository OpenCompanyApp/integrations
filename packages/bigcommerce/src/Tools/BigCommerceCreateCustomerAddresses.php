<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Create Customer Addresses.
 */
class BigCommerceCreateCustomerAddresses extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_create_customer_addresses';

    protected string $toolDescription = 'Create Customer Addresses.';

    protected string $method = 'POST';

    protected string $path = '/v3/customers/addresses';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Array of Customer Addresses records.',
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