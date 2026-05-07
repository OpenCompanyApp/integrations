<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one BigCommerce Category.
 */
class BigCommerceGetCategory extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_category';

    protected string $toolDescription = 'Get one BigCommerce Category.';

    protected string $method = 'GET';

    protected string $path = '/v3/catalog/categories/{category_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'category_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Category ID.',
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
  0 => 'category_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}