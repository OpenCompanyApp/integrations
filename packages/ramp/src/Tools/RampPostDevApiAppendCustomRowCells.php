<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Append cells to a Custom Table.
 *
 * Maps to the official Ramp endpoint post /developer/v1/custom-records/custom-tables/{table_name}/rows/-/append.
 */
class RampPostDevApiAppendCustomRowCells extends AbstractRampTool
{
    protected const NAME = 'ramp_post_dev_api_append_custom_row_cells';
    protected const DESCRIPTION = 'Append cells to a Custom Table

Official Ramp endpoint: POST /developer/v1/custom-records/custom-tables/{table_name}/rows/-/append';
    protected const PARAMETERS = array (
  'table_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `table_name` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/custom-records/custom-tables/{table_name}/rows/-/append';
    protected const PATH_PARAMS = array (
  'table_name' => 'table_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
