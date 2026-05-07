<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete Transformation Project.
 *
 * Maps to the official Fivetran endpoint delete /v1/transformation-projects/{projectId}.
 */
class FivetranDeleteTransformationProject extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_transformation_project';
    protected const DESCRIPTION = 'Delete Transformation Project

Official Fivetran endpoint: DELETE /v1/transformation-projects/{projectId}

Deletes transformation project if a valid identifier was provided.';
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
);
    protected const METHOD = 'delete';
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
