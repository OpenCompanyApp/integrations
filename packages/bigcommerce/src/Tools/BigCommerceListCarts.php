<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * List carts.
 */
class BigCommerceListCarts extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_list_carts';

    protected string $toolDescription = 'List carts.';

    protected string $method = 'GET';

    protected string $path = '/v3/carts';

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
  'include' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Related resources to include.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
  0 => 'limit',
  1 => 'page',
  2 => 'include',
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}