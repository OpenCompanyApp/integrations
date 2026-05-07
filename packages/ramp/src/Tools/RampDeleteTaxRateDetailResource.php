<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Delete a tax rate.
 *
 * Maps to the official Ramp endpoint delete /developer/v1/accounting/tax/rates/{tax_rate_id}.
 */
class RampDeleteTaxRateDetailResource extends AbstractRampTool
{
    protected const NAME = 'ramp_delete_tax_rate_detail_resource';
    protected const DESCRIPTION = 'Delete a tax rate

Official Ramp endpoint: DELETE /developer/v1/accounting/tax/rates/{tax_rate_id}';
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
    protected const METHOD = 'delete';
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
