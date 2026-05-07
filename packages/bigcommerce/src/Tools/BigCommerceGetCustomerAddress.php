<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one record from Customer Addresses.
 */
class BigCommerceGetCustomerAddress extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_customer_address';

    protected string $toolDescription = 'Get one record from Customer Addresses.';

    protected string $method = 'GET';

    protected string $path = '/v3/customers/addresses';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'address_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Record ID.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional documented query parameters.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'address_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
  'address_id' => 'id:in',
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}