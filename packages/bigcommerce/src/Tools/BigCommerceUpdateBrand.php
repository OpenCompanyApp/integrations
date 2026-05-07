<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update a BigCommerce Brand.
 */
class BigCommerceUpdateBrand extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_brand';

    protected string $toolDescription = 'Update a BigCommerce Brand.';

    protected string $method = 'PUT';

    protected string $path = '/v3/catalog/brands/{brand_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'brand_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Brand ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Brand fields to update.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'brand_id',
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