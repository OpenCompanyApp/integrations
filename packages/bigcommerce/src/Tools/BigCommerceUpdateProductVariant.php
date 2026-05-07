<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update a product Variant.
 */
class BigCommerceUpdateProductVariant extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_product_variant';

    protected string $toolDescription = 'Update a product Variant.';

    protected string $method = 'PUT';

    protected string $path = '/v3/catalog/products/{product_id}/variants/{variant_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'product_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce product ID.',
  ),
  'variant_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce product Variant ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Product Variant fields to update.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'product_id',
  1 => 'variant_id',
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