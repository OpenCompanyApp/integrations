<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Create or update records for a BigCommerce price list.
 */
class BigCommerceSetPriceListRecords extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_set_price_list_records';

    protected string $toolDescription = 'Create or update records for a BigCommerce price list.';

    protected string $method = 'PUT';

    protected string $path = '/v3/pricelists/{price_list_id}/records';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'price_list_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce price list ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Array of price list records.',
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