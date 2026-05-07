<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Metadata Stores Executions Delete.
 *
 * Maps to the official Vertex AI endpoint DELETE /v1/{+name}.
 */
class GoogleVertexAiProjectsLocationsMetadataStoresExecutionsDelete extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_metadata_stores_executions_delete';
    protected const DESCRIPTION = 'Projects Locations Metadata Stores Executions Delete

Official Vertex AI endpoint: DELETE /v1/{+name}
Deletes an Execution.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: etag.',
  ),
  'etag' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `etag`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'etag',
);
    protected const BODY_REQUIRED = false;
}
