<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Index Endpoints Deploy Index.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+indexEndpoint}:deployIndex.
 */
class GoogleVertexAiProjectsLocationsIndexEndpointsDeployIndex extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_index_endpoints_deploy_index';
    protected const DESCRIPTION = 'Projects Locations Index Endpoints Deploy Index

Official Vertex AI endpoint: POST /v1/{+indexEndpoint}:deployIndex
Deploys an Index into this IndexEndpoint, creating a DeployedIndex within it.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1DeployIndexRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+indexEndpoint}:deployIndex';
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
