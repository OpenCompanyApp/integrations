<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete a BigCommerce Category Tree.
 */
class BigCommerceDeleteCategoryTree extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_category_tree';

    protected string $toolDescription = 'Delete a BigCommerce Category Tree.';

    protected string $method = 'DELETE';

    protected string $path = '/v3/catalog/trees/{tree_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'tree_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Category Tree ID.',
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