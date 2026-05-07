<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update a v2 customer group.
 */
class BigCommerceUpdateCustomerGroup extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_customer_group';

    protected string $toolDescription = 'Update a v2 customer group.';

    protected string $method = 'PUT';

    protected string $path = '/v2/customer_groups/{customer_group_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'customer_group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Customer group ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Customer group fields to update.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'customer_group_id',
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