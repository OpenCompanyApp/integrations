<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Update a tax rate.
 *
 * Maps to the official Ramp endpoint patch /developer/v1/accounting/tax/rates/{tax_rate_id}.
 */
class RampPatchTaxRateDetailResource extends AbstractRampTool
{
    protected const NAME = 'ramp_patch_tax_rate_detail_resource';
    protected const DESCRIPTION = 'Update a tax rate

Official Ramp endpoint: PATCH /developer/v1/accounting/tax/rates/{tax_rate_id}';
    protected const PARAMETERS = array (
  'tax_rate_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tax_rate_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/developer/v1/accounting/tax/rates/{tax_rate_id}';
    protected const PATH_PARAMS = array (
  'tax_rate_id' => 'tax_rate_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
