<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one customer by ID using the v3 customers filter.
 */
class BigCommerceGetCustomer extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_customer';

    protected string $toolDescription = 'Get one customer by ID using the v3 customers filter.';

    protected string $method = 'GET';

    protected string $path = '/v3/customers';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'customer_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce customer ID.',
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
  0 => 'customer_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
  'customer_id' => 'id:in',
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}