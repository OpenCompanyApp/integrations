<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Reasoning Engines Memories Purge.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}/memories:purge.
 */
class GoogleVertexAiProjectsLocationsReasoningEnginesMemoriesPurge extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_reasoning_engines_memories_purge';
    protected const DESCRIPTION = 'Projects Locations Reasoning Engines Memories Purge

Official Vertex AI endpoint: POST /v1/{+parent}/memories:purge
Purge memories.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1PurgeMemoriesRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/memories:purge';
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
