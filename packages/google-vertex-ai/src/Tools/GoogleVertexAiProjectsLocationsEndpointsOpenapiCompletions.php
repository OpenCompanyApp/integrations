<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Endpoints Openapi Completions.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+endpoint}/completions.
 */
class GoogleVertexAiProjectsLocationsEndpointsOpenapiCompletions extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_endpoints_openapi_completions';
    protected const DESCRIPTION = 'Projects Locations Endpoints Openapi Completions

Official Vertex AI endpoint: POST /v1/{+endpoint}/completions
Forwards arbitrary HTTP requests for both streaming and non-streaming cases. To use this method, invoke_route_prefix must be set to allow the paths that will be specified in the request.';
    protected const PARAMETERS = array (
  'endpoint' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `endpoint`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: deployedModelId.',
  ),
  'deployedModelId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `deployedModelId`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleApiHttpBody` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+endpoint}/completions';
    protected const PATH_PARAMS = array (
  0 => 'endpoint',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'endpoint',
);
    protected const QUERY_KEYS = array (
  0 => 'deployedModelId',
);
    protected const BODY_REQUIRED = true;
}
