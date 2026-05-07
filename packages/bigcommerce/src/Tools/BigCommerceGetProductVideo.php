<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one product Video.
 */
class BigCommerceGetProductVideo extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_product_video';

    protected string $toolDescription = 'Get one product Video.';

    protected string $method = 'GET';

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
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'product_id',
  1 => 'video_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}