<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * List Customer Form Field Values.
 */
class BigCommerceListCustomerFormFieldValues extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_list_customer_form_field_values';

    protected string $toolDescription = 'List Customer Form Field Values.';

    protected string $method = 'GET';

    protected string $path = '/v3/customers/form-field-values';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
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
  'customer_id:in' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Comma-separated customer IDs.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
  0 => 'limit',
  1 => 'page',
  2 => 'customer_id:in',
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}