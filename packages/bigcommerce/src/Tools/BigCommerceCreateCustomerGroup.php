<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Create a v2 customer group.
 */
class BigCommerceCreateCustomerGroup extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_create_customer_group';

    protected string $toolDescription = 'Create a v2 customer group.';

    protected string $method = 'POST';

    protected string $path = '/v2/customer_groups';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Customer group fields.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'payload',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
  0 => 'payload',
);
}