<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Upload tax rates.
 *
 * Maps to the official Ramp endpoint post /developer/v1/accounting/tax/rates.
 */
class RampPostTaxCodeRatesListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_tax_code_rates_list_resource';
    protected const DESCRIPTION = 'Upload tax rates

Official Ramp endpoint: POST /developer/v1/accounting/tax/rates

You can upload up to 500 tax rates in an all-or-nothing fashion. If a tax rate within a batch is malformed or violates a database constraint, the entire batch will be disregarded. To have a successful upload, please sanitize the data and ensure the tax rates that you are trying to upload do not already exist on Ramp.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/accounting/tax/rates';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
