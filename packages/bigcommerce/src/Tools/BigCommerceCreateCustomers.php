<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Create one or more customers.
 */
class BigCommerceCreateCustomers extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_create_customers';

    protected string $toolDescription = 'Create one or more customers.';

    protected string $method = 'POST';

    protected string $path = '/v3/customers';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Array of customer objects accepted by BigCommerce v3 Customers.',
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