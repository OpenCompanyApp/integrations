<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Delete a custom accounting field option.
 *
 * Maps to the official Ramp endpoint delete /developer/v1/accounting/field-options/{field_option_id}.
 */
class RampDeleteCustomFieldOptionResource extends AbstractRampTool
{
    protected const NAME = 'ramp_delete_custom_field_option_resource';
    protected const DESCRIPTION = 'Delete a custom accounting field option

Official Ramp endpoint: DELETE /developer/v1/accounting/field-options/{field_option_id}';
    protected const PARAMETERS = array (
  'field_option_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `field_option_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/developer/v1/accounting/field-options/{field_option_id}';
    protected const PATH_PARAMS = array (
  'field_option_id' => 'field_option_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
