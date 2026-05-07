<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one BigCommerce Price List.
 */
class BigCommerceGetPriceList extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_price_list';

    protected string $toolDescription = 'Get one BigCommerce Price List.';

    protected string $method = 'GET';

    protected string $path = '/v3/pricelists/{price_list_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'price_list_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Price List ID.',
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
  0 => 'price_list_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}