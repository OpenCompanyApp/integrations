<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Create a BigCommerce Category Tree.
 */
class BigCommerceCreateCategoryTree extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_create_category_tree';

    protected string $toolDescription = 'Create a BigCommerce Category Tree.';

    protected string $method = 'POST';

    protected string $path = '/v3/catalog/trees';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Category Tree fields.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'payload',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
  0 => 'payload',
);
}