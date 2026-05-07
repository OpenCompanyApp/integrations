<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one product Modifier.
 */
class BigCommerceGetProductModifier extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_product_modifier';

    protected string $toolDescription = 'Get one product Modifier.';

    protected string $method = 'GET';

    protected string $path = '/v3/catalog/products/{product_id}/modifiers/{modifier_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'product_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce product ID.',
  ),
  'modifier_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce product Modifier ID.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'product_id',
  1 => 'modifier_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}