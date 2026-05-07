<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete a product Image.
 */
class BigCommerceDeleteProductImage extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_product_image';

    protected string $toolDescription = 'Delete a product Image.';

    protected string $method = 'DELETE';

    protected string $path = '/v3/catalog/products/{product_id}/images/{image_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'product_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce product ID.',
  ),
  'image_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce product Image ID.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'product_id',
  1 => 'image_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}