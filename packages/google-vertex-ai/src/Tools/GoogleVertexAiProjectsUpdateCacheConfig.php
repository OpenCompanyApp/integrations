<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Update Cache Config.
 *
 * Maps to the official Vertex AI endpoint PATCH /v1/{+name}.
 */
class GoogleVertexAiProjectsUpdateCacheConfig extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_update_cache_config';
    protected const DESCRIPTION = 'Projects Update Cache Config

Official Vertex AI endpoint: PATCH /v1/{+name}
Updates a cache config.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1CacheConfig` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/{+name}';
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
