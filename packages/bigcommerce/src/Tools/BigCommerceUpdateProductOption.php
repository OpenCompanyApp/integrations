<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update a product Option.
 */
class BigCommerceUpdateProductOption extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_product_option';

    protected string $toolDescription = 'Update a product Option.';

    protected string $method = 'PUT';

    protected string $path = '/v3/catalog/products/{product_id}/options/{option_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'product_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce product ID.',
  ),
  'option_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce product Option ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Product Option fields to update.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'product_id',
  1 => 'option_id',
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