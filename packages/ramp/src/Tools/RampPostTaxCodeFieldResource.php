<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create a new tax code accounting field.
 *
 * Maps to the official Ramp endpoint post /developer/v1/accounting/tax/code.
 */
class RampPostTaxCodeFieldResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_tax_code_field_resource';
    protected const DESCRIPTION = 'Create a new tax code accounting field

Official Ramp endpoint: POST /developer/v1/accounting/tax/code

There can only be one active tax code accounting field per accounting connection.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/accounting/tax/code';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
