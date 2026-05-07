<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete a catalog product.
 */
class BigCommerceDeleteProduct extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_product';

    protected string $toolDescription = 'Delete a catalog product.';

    protected string $method = 'DELETE';

    protected string $path = '/v3/catalog/products/{product_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'product_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce product ID.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'product_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}