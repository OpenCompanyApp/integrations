<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a department.
 *
 * Maps to the official Ramp endpoint get /developer/v1/departments/{department_id}.
 */
class RampGetDepartmentResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_department_resource';
    protected const DESCRIPTION = 'Fetch a department

Official Ramp endpoint: GET /developer/v1/departments/{department_id}';
    protected const PARAMETERS = array (
  'department_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `department_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/departments/{department_id}';
    protected const PATH_PARAMS = array (
  'department_id' => 'department_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
