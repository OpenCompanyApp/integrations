<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete customers by comma-separated IDs.
 */
class BigCommerceDeleteCustomers extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_customers';

    protected string $toolDescription = 'Delete customers by comma-separated IDs.';

    protected string $method = 'DELETE';

    protected string $path = '/v3/customers';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'customer_ids' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Comma-separated BigCommerce customer IDs.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional documented delete filters.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'customer_ids',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
  'customer_ids' => 'id:in',
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}