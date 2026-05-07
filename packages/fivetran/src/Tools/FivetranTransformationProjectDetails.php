<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Transformation Project Details.
 *
 * Maps to the official Fivetran endpoint get /v1/transformation-projects/{projectId}.
 */
class FivetranTransformationProjectDetails extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_transformation_project_details';
    protected const DESCRIPTION = 'Retrieve Transformation Project Details

Official Fivetran endpoint: GET /v1/transformation-projects/{projectId}

Returns transformation project details if a valid identifier was provided.';
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
    protected const METHOD = 'get';
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
