<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Publishers Models Compute Tokens.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+endpoint}:computeTokens.
 */
class GoogleVertexAiProjectsLocationsPublishersModelsComputeTokens extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_publishers_models_compute_tokens';
    protected const DESCRIPTION = 'Projects Locations Publishers Models Compute Tokens

Official Vertex AI endpoint: POST /v1/{+endpoint}:computeTokens
Return a list of tokens based on the input text.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1ComputeTokensRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+endpoint}:computeTokens';
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
