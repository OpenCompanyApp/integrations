<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Upsert Matrix table rows.
 *
 * Maps to the official Ramp endpoint put /developer/v1/custom-records/matrix-tables/{table_name}/rows.
 */
class RampPutDevApiMatrixPutRows extends AbstractRampTool
{
    protected const NAME = 'ramp_put_dev_api_matrix_put_rows';
    protected const DESCRIPTION = 'Upsert Matrix table rows

Official Ramp endpoint: PUT /developer/v1/custom-records/matrix-tables/{table_name}/rows

Creates new rows or updates existing rows based on input values. Input values define row identity (via external_key). Result values are mutable and can be partially updated.';
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
    protected const METHOD = 'put';
    protected const PATH = '/developer/v1/custom-records/matrix-tables/{table_name}/rows';
    protected const PATH_PARAMS = array (
  'table_name' => 'table_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
