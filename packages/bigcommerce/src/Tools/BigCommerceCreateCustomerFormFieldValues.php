<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Create Customer Form Field Values.
 */
class BigCommerceCreateCustomerFormFieldValues extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_create_customer_form_field_values';

    protected string $toolDescription = 'Create Customer Form Field Values.';

    protected string $method = 'POST';

    protected string $path = '/v3/customers/form-field-values';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Array of Customer Form Field Values records.',
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