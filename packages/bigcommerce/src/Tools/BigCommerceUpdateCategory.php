<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update a BigCommerce Category.
 */
class BigCommerceUpdateCategory extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_category';

    protected string $toolDescription = 'Update a BigCommerce Category.';

    protected string $method = 'PUT';

    protected string $path = '/v3/catalog/categories/{category_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'category_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Category ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Category fields to update.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'category_id',
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