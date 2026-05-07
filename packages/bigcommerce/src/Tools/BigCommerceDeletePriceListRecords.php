<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete price list records by query filters.
 */
class BigCommerceDeletePriceListRecords extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_price_list_records';

    protected string $toolDescription = 'Delete price list records by query filters.';

    protected string $method = 'DELETE';

    protected string $path = '/v3/pricelists/{price_list_id}/records';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'price_list_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce price list ID.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Documented BigCommerce price list record delete filters.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'price_list_id',
  1 => 'query',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}