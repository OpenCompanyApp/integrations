<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Delete rows from a Custom Table.
 *
 * Maps to the official Ramp endpoint delete /developer/v1/custom-records/custom-tables/{custom_table_name}/rows.
 */
class RampDeleteDevApiCustomRow extends AbstractRampTool
{
    protected const NAME = 'ramp_delete_dev_api_custom_row';
    protected const DESCRIPTION = 'Delete rows from a Custom Table

Official Ramp endpoint: DELETE /developer/v1/custom-records/custom-tables/{custom_table_name}/rows';
    protected const PARAMETERS = array (
  'custom_table_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `custom_table_name` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/developer/v1/custom-records/custom-tables/{custom_table_name}/rows';
    protected const PATH_PARAMS = array (
  'custom_table_name' => 'custom_table_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
