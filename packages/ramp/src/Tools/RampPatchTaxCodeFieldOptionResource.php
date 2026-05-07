<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Update a tax code option.
 *
 * Maps to the official Ramp endpoint patch /developer/v1/accounting/tax/code/options/{option_id}.
 */
class RampPatchTaxCodeFieldOptionResource extends AbstractRampTool
{
    protected const NAME = 'ramp_patch_tax_code_field_option_resource';
    protected const DESCRIPTION = 'Update a tax code option

Official Ramp endpoint: PATCH /developer/v1/accounting/tax/code/options/{option_id}';
    protected const PARAMETERS = array (
  'option_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `option_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/developer/v1/accounting/tax/code/options/{option_id}';
    protected const PATH_PARAMS = array (
  'option_id' => 'option_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
