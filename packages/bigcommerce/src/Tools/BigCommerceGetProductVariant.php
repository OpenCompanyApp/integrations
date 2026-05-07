<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one product Variant.
 */
class BigCommerceGetProductVariant extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_product_variant';

    protected string $toolDescription = 'Get one product Variant.';

    protected string $method = 'GET';

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
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'product_id',
  1 => 'variant_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}