<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * List v2 customer groups.
 */
class BigCommerceListCustomerGroups extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_list_customer_groups';

    protected string $toolDescription = 'List v2 customer groups.';

    protected string $method = 'GET';

    protected string $path = '/v2/customer_groups';

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
);

    /** @var list<string> */
    protected array $required = array (
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
  0 => 'limit',
  1 => 'page',
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}