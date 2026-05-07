<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Augment Prompt.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}:augmentPrompt.
 */
class GoogleVertexAiProjectsLocationsAugmentPrompt extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_augment_prompt';
    protected const DESCRIPTION = 'Projects Locations Augment Prompt

Official Vertex AI endpoint: POST /v1/{+parent}:augmentPrompt
Given an input prompt, it returns augmented prompt from vertex rag store to guide LLM towards generating grounded responses.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1AugmentPromptRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}:augmentPrompt';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
