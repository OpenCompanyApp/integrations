<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one catalog product by ID.
 */
class BigCommerceGetProduct extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_product';

    protected string $toolDescription = 'Get one catalog product by ID.';

    protected string $method = 'GET';

    protected string $path = '/v3/catalog/products/{product_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'product_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce product ID.',
  ),
  'include' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Comma-separated related resources to include.',
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
  0 => 'product_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
  0 => 'include',
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}