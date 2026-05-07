<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Reasoning Engines Sandbox Environments Snapshot.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+name}:snapshot.
 */
class GoogleVertexAiReasoningEnginesSandboxEnvironmentsSnapshot extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_reasoning_engines_sandbox_environments_snapshot';
    protected const DESCRIPTION = 'Reasoning Engines Sandbox Environments Snapshot

Official Vertex AI endpoint: POST /v1/{+name}:snapshot
Snapshots the specific SandboxEnvironment resource and creates a SandboxEnvironmentSnapshot resource.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1SandboxEnvironmentSnapshot` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+name}:snapshot';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
