<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update one or more customers.
 */
class BigCommerceUpdateCustomers extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_customers';

    protected string $toolDescription = 'Update one or more customers.';

    protected string $method = 'PUT';

    protected string $path = '/v3/customers';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Array of customer objects with IDs and updated fields.',
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