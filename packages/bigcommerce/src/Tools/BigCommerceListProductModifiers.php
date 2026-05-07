<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * List modifiers for a catalog product.
 */
class BigCommerceListProductModifiers extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_list_product_modifiers';

    protected string $toolDescription = 'List modifiers for a catalog product.';

    protected string $method = 'GET';

    protected string $path = '/v3/catalog/products/{product_id}/modifiers';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'product_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce product ID.',
  ),
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
  0 => 'product_id',
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