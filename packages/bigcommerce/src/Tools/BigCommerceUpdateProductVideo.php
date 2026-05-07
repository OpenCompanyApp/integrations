<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update a product Video.
 */
class BigCommerceUpdateProductVideo extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_product_video';

    protected string $toolDescription = 'Update a product Video.';

    protected string $method = 'PUT';

    protected string $path = '/v3/catalog/products/{product_id}/videos/{video_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'product_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce product ID.',
  ),
  'video_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce product Video ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Product Video fields to update.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'product_id',
  1 => 'video_id',
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