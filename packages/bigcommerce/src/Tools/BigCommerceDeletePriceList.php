<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete a BigCommerce Price List.
 */
class BigCommerceDeletePriceList extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_price_list';

    protected string $toolDescription = 'Delete a BigCommerce Price List.';

    protected string $method = 'DELETE';

    protected string $path = '/v3/pricelists/{price_list_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'price_list_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Price List ID.',
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