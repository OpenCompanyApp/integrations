<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update a product Custom Field.
 */
class BigCommerceUpdateProductCustomField extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_product_custom_field';

    protected string $toolDescription = 'Update a product Custom Field.';

    protected string $method = 'PUT';

    protected string $path = '/v3/catalog/products/{product_id}/custom-fields/{custom_field_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'product_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce product ID.',
  ),
  'custom_field_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce product Custom Field ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Product Custom Field fields to update.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'product_id',
  1 => 'custom_field_id',
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