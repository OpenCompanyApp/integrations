<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create Custom Table column.
 *
 * Maps to the official Ramp endpoint post /developer/v1/custom-records/configure/custom-tables/{custom_table_name}/columns.
 */
class RampPostDevApiConfigureCustomTableColumns extends AbstractRampTool
{
    protected const NAME = 'ramp_post_dev_api_configure_custom_table_columns';
    protected const DESCRIPTION = 'Create Custom Table column

Official Ramp endpoint: POST /developer/v1/custom-records/configure/custom-tables/{custom_table_name}/columns';
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
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/custom-records/configure/custom-tables/{custom_table_name}/columns';
    protected const PATH_PARAMS = array (
  'custom_table_name' => 'custom_table_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
