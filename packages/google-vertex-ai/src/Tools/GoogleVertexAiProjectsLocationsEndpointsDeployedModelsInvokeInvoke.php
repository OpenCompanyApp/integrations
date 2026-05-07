<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Endpoints Deployed Models Invoke Invoke.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+endpoint}/deployedModels/{deployedModelId}/invoke/{+invokeId}.
 */
class GoogleVertexAiProjectsLocationsEndpointsDeployedModelsInvokeInvoke extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_endpoints_deployed_models_invoke_invoke';
    protected const DESCRIPTION = 'Projects Locations Endpoints Deployed Models Invoke Invoke

Official Vertex AI endpoint: POST /v1/{+endpoint}/deployedModels/{deployedModelId}/invoke/{+invokeId}
Forwards arbitrary HTTP requests for both streaming and non-streaming cases. To use this method, invoke_route_prefix must be set to allow the paths that will be specified in the request.';
    protected const PARAMETERS = array (
  'endpoint' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `endpoint`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'deployedModelId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `deployedModelId`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'invokeId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `invokeId`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1InvokeRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+endpoint}/deployedModels/{deployedModelId}/invoke/{+invokeId}';
    protected const PATH_PARAMS = array (
  0 => 'endpoint',
  1 => 'deployedModelId',
  2 => 'invokeId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'endpoint',
  1 => 'invokeId',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
