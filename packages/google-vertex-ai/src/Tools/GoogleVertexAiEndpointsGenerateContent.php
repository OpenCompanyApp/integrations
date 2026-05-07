<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Endpoints Generate Content.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+model}:generateContent.
 */
class GoogleVertexAiEndpointsGenerateContent extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_endpoints_generate_content';
    protected const DESCRIPTION = 'Endpoints Generate Content

Official Vertex AI endpoint: POST /v1/{+model}:generateContent
Generate content with multimodal inputs.';
    protected const PARAMETERS = array (
  'model' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `model`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1GenerateContentRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+model}:generateContent';
    protected const PATH_PARAMS = array (
  0 => 'model',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'model',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
