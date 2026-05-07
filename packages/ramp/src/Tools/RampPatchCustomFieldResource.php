<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Update a custom accounting field.
 *
 * Maps to the official Ramp endpoint patch /developer/v1/accounting/fields/{field_id}.
 */
class RampPatchCustomFieldResource extends AbstractRampTool
{
    protected const NAME = 'ramp_patch_custom_field_resource';
    protected const DESCRIPTION = 'Update a custom accounting field

Official Ramp endpoint: PATCH /developer/v1/accounting/fields/{field_id}';
    protected const PARAMETERS = array (
  'field_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `field_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/developer/v1/accounting/fields/{field_id}';
    protected const PATH_PARAMS = array (
  'field_id' => 'field_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
