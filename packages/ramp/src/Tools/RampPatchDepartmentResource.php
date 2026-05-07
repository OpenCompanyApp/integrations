<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Update a department.
 *
 * Maps to the official Ramp endpoint patch /developer/v1/departments/{department_id}.
 */
class RampPatchDepartmentResource extends AbstractRampTool
{
    protected const NAME = 'ramp_patch_department_resource';
    protected const DESCRIPTION = 'Update a department

Official Ramp endpoint: PATCH /developer/v1/departments/{department_id}';
    protected const PARAMETERS = array (
  'department_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `department_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/developer/v1/departments/{department_id}';
    protected const PATH_PARAMS = array (
  'department_id' => 'department_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
