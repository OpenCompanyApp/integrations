<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * List customers with BigCommerce v3 filters.
 */
class BigCommerceListCustomers extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_list_customers';

    protected string $toolDescription = 'List customers with BigCommerce v3 filters.';

    protected string $method = 'GET';

    protected string $path = '/v3/customers';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Maximum number of records to return.',
  ),
  'page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Page number for paginated endpoints.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional documented BigCommerce query parameters to pass through.',
  ),
  'email:in' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Comma-separated customer emails.',
  ),
  'name:like' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Name search filter.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
  0 => 'limit',
  1 => 'page',
  2 => 'email:in',
  3 => 'name:like',
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}