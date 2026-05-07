<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one BigCommerce Brand.
 */
class BigCommerceGetBrand extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_brand';

    protected string $toolDescription = 'Get one BigCommerce Brand.';

    protected string $method = 'GET';

    protected string $path = '/v3/catalog/brands/{brand_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'brand_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Brand ID.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional documented query parameters.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'brand_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}