<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update Transformation Project.
 *
 * Maps to the official Fivetran endpoint patch /v1/transformation-projects/{projectId}.
 */
class FivetranModifyTransformationProject extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_modify_transformation_project';
    protected const DESCRIPTION = 'Update Transformation Project

Official Fivetran endpoint: PATCH /v1/transformation-projects/{projectId}

Updates transformation project if a valid identifier was provided.';
    protected const PARAMETERS = array (
  'project_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectId` from the official Fivetran API operation. The unique identifier for the transformation project within the Fivetran system',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/transformation-projects/{projectId}';
    protected const PATH_PARAMS = array (
  'projectId' => 'project_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
