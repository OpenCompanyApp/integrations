<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Metadata Stores Contexts Get.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+name}.
 */
class GoogleVertexAiProjectsLocationsMetadataStoresContextsGet extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_metadata_stores_contexts_get';
    protected const DESCRIPTION = 'Projects Locations Metadata Stores Contexts Get

Official Vertex AI endpoint: GET /v1/{+name}
Retrieves a specific Context.';
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
