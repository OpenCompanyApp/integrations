<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Publishers Models Stream Generate Content.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+model}:streamGenerateContent.
 */
class GoogleVertexAiPublishersModelsStreamGenerateContent extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_publishers_models_stream_generate_content';
    protected const DESCRIPTION = 'Publishers Models Stream Generate Content

Official Vertex AI endpoint: POST /v1/{+model}:streamGenerateContent
Generate content with multimodal inputs with streaming support.';
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
    protected const PATH = '/v1/{+model}:streamGenerateContent';
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
