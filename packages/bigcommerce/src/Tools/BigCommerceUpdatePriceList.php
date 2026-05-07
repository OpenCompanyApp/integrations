<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update a BigCommerce Price List.
 */
class BigCommerceUpdatePriceList extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_price_list';

    protected string $toolDescription = 'Update a BigCommerce Price List.';

    protected string $method = 'PUT';

    protected string $path = '/v3/pricelists/{price_list_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'price_list_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Price List ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Price List fields to update.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'price_list_id',
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