<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Change the API name of a Matrix table.
 *
 * Maps to the official Ramp endpoint post /developer/v1/custom-records/matrix-tables/{table_name}/rename.
 */
class RampPostDevApiRenameMatrixTable extends AbstractRampTool
{
    protected const NAME = 'ramp_post_dev_api_rename_matrix_table';
    protected const DESCRIPTION = 'Change the API name of a Matrix table

Official Ramp endpoint: POST /developer/v1/custom-records/matrix-tables/{table_name}/rename';
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
    protected const PATH = '/developer/v1/custom-records/matrix-tables/{table_name}/rename';
    protected const PATH_PARAMS = array (
  'table_name' => 'table_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
