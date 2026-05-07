<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Publishers Models Server Streaming Predict.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+endpoint}:serverStreamingPredict.
 */
class GoogleVertexAiProjectsLocationsPublishersModelsServerStreamingPredict extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_publishers_models_server_streaming_predict';
    protected const DESCRIPTION = 'Projects Locations Publishers Models Server Streaming Predict

Official Vertex AI endpoint: POST /v1/{+endpoint}:serverStreamingPredict
Perform a server-side streaming online prediction request for Vertex LLM streaming.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1StreamingPredictRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+endpoint}:serverStreamingPredict';
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
