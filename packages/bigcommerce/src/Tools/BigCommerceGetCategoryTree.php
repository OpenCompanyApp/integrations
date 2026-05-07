<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one BigCommerce Category Tree.
 */
class BigCommerceGetCategoryTree extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_category_tree';

    protected string $toolDescription = 'Get one BigCommerce Category Tree.';

    protected string $method = 'GET';

    protected string $path = '/v3/catalog/trees/{tree_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'tree_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Category Tree ID.',
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
  0 => 'tree_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}