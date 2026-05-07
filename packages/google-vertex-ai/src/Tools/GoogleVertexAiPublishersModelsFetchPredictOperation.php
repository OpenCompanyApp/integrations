<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Publishers Models Fetch Predict Operation.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+endpoint}:fetchPredictOperation.
 */
class GoogleVertexAiPublishersModelsFetchPredictOperation extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_publishers_models_fetch_predict_operation';
    protected const DESCRIPTION = 'Publishers Models Fetch Predict Operation

Official Vertex AI endpoint: POST /v1/{+endpoint}:fetchPredictOperation
Fetch an asynchronous online prediction operation.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1FetchPredictOperationRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+endpoint}:fetchPredictOperation';
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
