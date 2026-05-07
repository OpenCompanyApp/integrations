<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Reasoning Engines Sandbox Environments Get.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+name}.
 */
class GoogleVertexAiReasoningEnginesSandboxEnvironmentsGet extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_reasoning_engines_sandbox_environments_get';
    protected const DESCRIPTION = 'Reasoning Engines Sandbox Environments Get

Official Vertex AI endpoint: GET /v1/{+name}
Gets details of the specific SandboxEnvironment.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
