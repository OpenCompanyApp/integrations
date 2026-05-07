<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * List records for a BigCommerce price list.
 */
class BigCommerceListPriceListRecords extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_list_price_list_records';

    protected string $toolDescription = 'List records for a BigCommerce price list.';

    protected string $method = 'GET';

    protected string $path = '/v3/pricelists/{price_list_id}/records';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'price_list_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce price list ID.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Maximum number of records to return.',
  ),
  'page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Page number for paginated endpoints.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional documented BigCommerce query parameters to pass through.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'price_list_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
  0 => 'limit',
  1 => 'page',
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}