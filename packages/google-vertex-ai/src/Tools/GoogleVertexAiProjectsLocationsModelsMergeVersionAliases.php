<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Models Merge Version Aliases.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+name}:mergeVersionAliases.
 */
class GoogleVertexAiProjectsLocationsModelsMergeVersionAliases extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_models_merge_version_aliases';
    protected const DESCRIPTION = 'Projects Locations Models Merge Version Aliases

Official Vertex AI endpoint: POST /v1/{+name}:mergeVersionAliases
Merges a set of aliases for a Model version.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1MergeVersionAliasesRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+name}:mergeVersionAliases';
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
