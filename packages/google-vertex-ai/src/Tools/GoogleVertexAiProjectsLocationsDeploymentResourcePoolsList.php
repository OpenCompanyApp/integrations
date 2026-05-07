<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Deployment Resource Pools List.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+parent}/deploymentResourcePools.
 */
class GoogleVertexAiProjectsLocationsDeploymentResourcePoolsList extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_deployment_resource_pools_list';
    protected const DESCRIPTION = 'Projects Locations Deployment Resource Pools List

Official Vertex AI endpoint: GET /v1/{+parent}/deploymentResourcePools
List DeploymentResourcePools in a location.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
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
    protected const PATH = '/v1/{+parent}/deploymentResourcePools';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}
