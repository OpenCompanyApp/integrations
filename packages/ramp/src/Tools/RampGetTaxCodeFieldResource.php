<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch tax code accounting field.
 *
 * Maps to the official Ramp endpoint get /developer/v1/accounting/tax/code.
 */
class RampGetTaxCodeFieldResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_tax_code_field_resource';
    protected const DESCRIPTION = 'Fetch tax code accounting field

Official Ramp endpoint: GET /developer/v1/accounting/tax/code

Returns the tax code accounting field for the current accounting connection.';
    protected const PARAMETERS = array (
  'accounting_connection_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `accounting_connection_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/accounting/tax/code';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'accounting_connection_id' => 'accounting_connection_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
