<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete Customer Form Field Values by comma-separated IDs.
 */
class BigCommerceDeleteCustomerFormFieldValues extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_customer_form_field_values';

    protected string $toolDescription = 'Delete Customer Form Field Values by comma-separated IDs.';

    protected string $method = 'DELETE';

    protected string $path = '/v3/customers/form-field-values';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'ids' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Comma-separated record IDs.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional documented delete filters.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'ids',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
  'ids' => 'id:in',
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}