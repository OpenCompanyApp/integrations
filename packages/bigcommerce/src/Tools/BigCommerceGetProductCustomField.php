<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one product Custom Field.
 */
class BigCommerceGetProductCustomField extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_product_custom_field';

    protected string $toolDescription = 'Get one product Custom Field.';

    protected string $method = 'GET';

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
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'product_id',
  1 => 'custom_field_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}