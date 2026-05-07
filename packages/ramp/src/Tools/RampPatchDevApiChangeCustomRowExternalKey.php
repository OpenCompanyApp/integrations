<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Change the external key of a Custom Table row.
 *
 * Maps to the official Ramp endpoint patch /developer/v1/custom-records/custom-tables/{custom_table_name}/rows/{row_id}.
 */
class RampPatchDevApiChangeCustomRowExternalKey extends AbstractRampTool
{
    protected const NAME = 'ramp_patch_dev_api_change_custom_row_external_key';
    protected const DESCRIPTION = 'Change the external key of a Custom Table row

Official Ramp endpoint: PATCH /developer/v1/custom-records/custom-tables/{custom_table_name}/rows/{row_id}';
    protected const PARAMETERS = array (
  'custom_table_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `custom_table_name` from the official Ramp API operation.',
  ),
  'row_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `row_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/developer/v1/custom-records/custom-tables/{custom_table_name}/rows/{row_id}';
    protected const PATH_PARAMS = array (
  'custom_table_name' => 'custom_table_name',
  'row_id' => 'row_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
