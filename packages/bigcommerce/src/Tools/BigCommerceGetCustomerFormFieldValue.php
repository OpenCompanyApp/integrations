<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one record from Customer Form Field Values.
 */
class BigCommerceGetCustomerFormFieldValue extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_customer_form_field_value';

    protected string $toolDescription = 'Get one record from Customer Form Field Values.';

    protected string $method = 'GET';

    protected string $path = '/v3/customers/form-field-values';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'form_field_value_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Record ID.',
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
  0 => 'form_field_value_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
  'form_field_value_id' => 'id:in',
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}