<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Deployment Resource Pools Query Deployed Models.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+deploymentResourcePool}:queryDeployedModels.
 */
class GoogleVertexAiProjectsLocationsDeploymentResourcePoolsQueryDeployedModels extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_deployment_resource_pools_query_deployed_models';
    protected const DESCRIPTION = 'Projects Locations Deployment Resource Pools Query Deployed Models

Official Vertex AI endpoint: GET /v1/{+deploymentResourcePool}:queryDeployedModels
List DeployedModels that have been deployed on this DeploymentResourcePool.';
    protected const PARAMETERS = array (
  'deploymentResourcePool' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `deploymentResourcePool`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: pageSize, pageToken.',
  ),
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+deploymentResourcePool}:queryDeployedModels';
    protected const PATH_PARAMS = array (
  0 => 'deploymentResourcePool',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'deploymentResourcePool',
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}
