<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update a product Modifier.
 */
class BigCommerceUpdateProductModifier extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_product_modifier';

    protected string $toolDescription = 'Update a product Modifier.';

    protected string $method = 'PUT';

    protected string $path = '/v3/catalog/products/{product_id}/modifiers/{modifier_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'product_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce product ID.',
  ),
  'modifier_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce product Modifier ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Product Modifier fields to update.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'product_id',
  1 => 'modifier_id',
  2 => 'payload',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
  0 => 'payload',
);
}