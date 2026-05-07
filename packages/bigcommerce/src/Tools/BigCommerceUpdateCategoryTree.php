<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update a BigCommerce Category Tree.
 */
class BigCommerceUpdateCategoryTree extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_category_tree';

    protected string $toolDescription = 'Update a BigCommerce Category Tree.';

    protected string $method = 'PUT';

    protected string $path = '/v3/catalog/trees/{tree_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'tree_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Category Tree ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Category Tree fields to update.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'tree_id',
  1 => 'payload',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
  0 => 'payload',
);
}