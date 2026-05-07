<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one product Option.
 */
class BigCommerceGetProductOption extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_product_option';

    protected string $toolDescription = 'Get one product Option.';

    protected string $method = 'GET';

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
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'product_id',
  1 => 'option_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}