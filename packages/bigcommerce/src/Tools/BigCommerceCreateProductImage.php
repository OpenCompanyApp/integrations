<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Create a product Image.
 */
class BigCommerceCreateProductImage extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_create_product_image';

    protected string $toolDescription = 'Create a product Image.';

    protected string $method = 'POST';

    protected string $path = '/v3/catalog/products/{product_id}/images';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'product_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce product ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Product Image fields.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'product_id',
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