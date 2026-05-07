<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List tax rates.
 *
 * Maps to the official Ramp endpoint get /developer/v1/accounting/tax/rates.
 */
class RampGetTaxCodeRatesListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_tax_code_rates_list_resource';
    protected const DESCRIPTION = 'List tax rates

Official Ramp endpoint: GET /developer/v1/accounting/tax/rates';
    protected const PARAMETERS = array (
  'accounting_connection_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `accounting_connection_id` from the official Ramp API operation.',
  ),
  'start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `start` from the official Ramp API operation.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `page_size` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/accounting/tax/rates';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'accounting_connection_id' => 'accounting_connection_id',
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
