<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Endpoints Predict Long Running.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+endpoint}:predictLongRunning.
 */
class GoogleVertexAiProjectsLocationsEndpointsPredictLongRunning extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_endpoints_predict_long_running';
    protected const DESCRIPTION = 'Projects Locations Endpoints Predict Long Running

Official Vertex AI endpoint: POST /v1/{+endpoint}:predictLongRunning
Google Vertex AI API operation.';
    protected const PARAMETERS = array (
  'endpoint' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `endpoint`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1PredictLongRunningRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+endpoint}:predictLongRunning';
    protected const PATH_PARAMS = array (
  0 => 'endpoint',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'endpoint',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
