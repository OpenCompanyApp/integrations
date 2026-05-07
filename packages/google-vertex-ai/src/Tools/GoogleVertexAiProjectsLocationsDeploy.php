<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Deploy.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+destination}:deploy.
 */
class GoogleVertexAiProjectsLocationsDeploy extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_deploy';
    protected const DESCRIPTION = 'Projects Locations Deploy

Official Vertex AI endpoint: POST /v1/{+destination}:deploy
Deploys a model to a new endpoint.';
    protected const PARAMETERS = array (
  'destination' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `destination`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1DeployRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+destination}:deploy';
    protected const PATH_PARAMS = array (
  0 => 'destination',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'destination',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
