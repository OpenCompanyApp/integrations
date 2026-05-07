<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete a BigCommerce Brand.
 */
class BigCommerceDeleteBrand extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_brand';

    protected string $toolDescription = 'Delete a BigCommerce Brand.';

    protected string $method = 'DELETE';

    protected string $path = '/v3/catalog/brands/{brand_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'brand_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Brand ID.',
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