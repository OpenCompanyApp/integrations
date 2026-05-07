<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one v2 customer group.
 */
class BigCommerceGetCustomerGroup extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_customer_group';

    protected string $toolDescription = 'Get one v2 customer group.';

    protected string $method = 'GET';

    protected string $path = '/v2/customer_groups/{customer_group_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'customer_group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Customer group ID.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'customer_group_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}