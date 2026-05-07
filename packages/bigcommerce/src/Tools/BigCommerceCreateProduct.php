<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Create a catalog product.
 */
class BigCommerceCreateProduct extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_create_product';

    protected string $toolDescription = 'Create a catalog product.';

    protected string $method = 'POST';

    protected string $path = '/v3/catalog/products';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'BigCommerce product fields such as name, type, price, weight, categories, and inventory settings.',
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