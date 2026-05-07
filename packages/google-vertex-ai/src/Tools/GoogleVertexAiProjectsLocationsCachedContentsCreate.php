<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Cached Contents Create.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}/cachedContents.
 */
class GoogleVertexAiProjectsLocationsCachedContentsCreate extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_cached_contents_create';
    protected const DESCRIPTION = 'Projects Locations Cached Contents Create

Official Vertex AI endpoint: POST /v1/{+parent}/cachedContents
Creates cached content, this call will initialize the cached content in the data storage, and users need to pay for the cache data storage.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1CachedContent` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/cachedContents';
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
