<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Delete a single Matrix table row by ID.
 *
 * Maps to the official Ramp endpoint delete /developer/v1/custom-records/matrix-tables/{table_name}/rows/{row_id}.
 */
class RampDeleteDevApiDeleteMatrixRow extends AbstractRampTool
{
    protected const NAME = 'ramp_delete_dev_api_delete_matrix_row';
    protected const DESCRIPTION = 'Delete a single Matrix table row by ID

Official Ramp endpoint: DELETE /developer/v1/custom-records/matrix-tables/{table_name}/rows/{row_id}

Deletes the matrix row with the specified ID from the matrix table.';
    protected const PARAMETERS = array (
  'table_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `table_name` from the official Ramp API operation.',
  ),
  'row_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `row_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/developer/v1/custom-records/matrix-tables/{table_name}/rows/{row_id}';
    protected const PATH_PARAMS = array (
  'table_name' => 'table_name',
  'row_id' => 'row_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
