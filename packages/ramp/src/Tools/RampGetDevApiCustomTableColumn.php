<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List Custom Table columns.
 *
 * Maps to the official Ramp endpoint get /developer/v1/custom-records/custom-tables/{custom_table_name}/columns.
 */
class RampGetDevApiCustomTableColumn extends AbstractRampTool
{
    protected const NAME = 'ramp_get_dev_api_custom_table_column';
    protected const DESCRIPTION = 'List Custom Table columns

Official Ramp endpoint: GET /developer/v1/custom-records/custom-tables/{custom_table_name}/columns';
    protected const PARAMETERS = array (
  'custom_table_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `custom_table_name` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/custom-records/custom-tables/{custom_table_name}/columns';
    protected const PATH_PARAMS = array (
  'custom_table_name' => 'custom_table_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
