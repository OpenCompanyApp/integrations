<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Index Endpoints Mutate Deployed Index.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+indexEndpoint}:mutateDeployedIndex.
 */
class GoogleVertexAiProjectsLocationsIndexEndpointsMutateDeployedIndex extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_index_endpoints_mutate_deployed_index';
    protected const DESCRIPTION = 'Projects Locations Index Endpoints Mutate Deployed Index

Official Vertex AI endpoint: POST /v1/{+indexEndpoint}:mutateDeployedIndex
Update an existing DeployedIndex under an IndexEndpoint.';
    protected const PARAMETERS = array (
  'indexEndpoint' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `indexEndpoint`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1DeployedIndex` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+indexEndpoint}:mutateDeployedIndex';
    protected const PATH_PARAMS = array (
  0 => 'indexEndpoint',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'indexEndpoint',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
