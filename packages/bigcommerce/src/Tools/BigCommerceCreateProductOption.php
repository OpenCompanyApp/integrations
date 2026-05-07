<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Create a product Option.
 */
class BigCommerceCreateProductOption extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_create_product_option';

    protected string $toolDescription = 'Create a product Option.';

    protected string $method = 'POST';

    protected string $path = '/v3/catalog/products/{product_id}/options';

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
    'description' => 'Product Option fields.',
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