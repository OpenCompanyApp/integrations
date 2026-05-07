<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Endpoints Direct Raw Predict.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+endpoint}:directRawPredict.
 */
class GoogleVertexAiProjectsLocationsEndpointsDirectRawPredict extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_endpoints_direct_raw_predict';
    protected const DESCRIPTION = 'Projects Locations Endpoints Direct Raw Predict

Official Vertex AI endpoint: POST /v1/{+endpoint}:directRawPredict
Perform an unary online prediction request to a gRPC model server for custom containers.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1DirectRawPredictRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+endpoint}:directRawPredict';
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
