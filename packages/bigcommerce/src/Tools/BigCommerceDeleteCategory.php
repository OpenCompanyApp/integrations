<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete a BigCommerce Category.
 */
class BigCommerceDeleteCategory extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_category';

    protected string $toolDescription = 'Delete a BigCommerce Category.';

    protected string $method = 'DELETE';

    protected string $path = '/v3/catalog/categories/{category_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'category_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Category ID.',
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