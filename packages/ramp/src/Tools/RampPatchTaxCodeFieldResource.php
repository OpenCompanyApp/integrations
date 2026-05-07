<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Update tax code accounting field.
 *
 * Maps to the official Ramp endpoint patch /developer/v1/accounting/tax/code.
 */
class RampPatchTaxCodeFieldResource extends AbstractRampTool
{
    protected const NAME = 'ramp_patch_tax_code_field_resource';
    protected const DESCRIPTION = 'Update tax code accounting field

Official Ramp endpoint: PATCH /developer/v1/accounting/tax/code';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/developer/v1/accounting/tax/code';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
