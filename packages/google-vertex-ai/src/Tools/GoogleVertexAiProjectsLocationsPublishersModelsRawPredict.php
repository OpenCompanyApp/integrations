<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Publishers Models Raw Predict.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+endpoint}:rawPredict.
 */
class GoogleVertexAiProjectsLocationsPublishersModelsRawPredict extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_publishers_models_raw_predict';
    protected const DESCRIPTION = 'Projects Locations Publishers Models Raw Predict

Official Vertex AI endpoint: POST /v1/{+endpoint}:rawPredict
Perform an online prediction with an arbitrary HTTP payload. The response includes the following HTTP headers: * `X-Vertex-AI-Endpoint-Id`: ID of the Endpoint that served this prediction. * `X-Vertex-AI-Deployed-Model-Id`: ID of the Endpoint\'s DeployedModel that served this prediction.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1RawPredictRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+endpoint}:rawPredict';
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
