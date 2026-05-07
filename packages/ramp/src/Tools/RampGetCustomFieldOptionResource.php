<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a custom accounting field option.
 *
 * Maps to the official Ramp endpoint get /developer/v1/accounting/field-options/{field_option_id}.
 */
class RampGetCustomFieldOptionResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_custom_field_option_resource';
    protected const DESCRIPTION = 'Fetch a custom accounting field option

Official Ramp endpoint: GET /developer/v1/accounting/field-options/{field_option_id}';
    protected const PARAMETERS = array (
  'field_option_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `field_option_id` from the official Ramp API operation.',
  ),
  'accounting_connection_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `accounting_connection_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/accounting/field-options/{field_option_id}';
    protected const PATH_PARAMS = array (
  'field_option_id' => 'field_option_id',
);
    protected const QUERY_PARAMS = array (
  'accounting_connection_id' => 'accounting_connection_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
