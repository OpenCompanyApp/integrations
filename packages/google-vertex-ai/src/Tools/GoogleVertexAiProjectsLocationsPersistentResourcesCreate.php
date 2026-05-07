<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Persistent Resources Create.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}/persistentResources.
 */
class GoogleVertexAiProjectsLocationsPersistentResourcesCreate extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_persistent_resources_create';
    protected const DESCRIPTION = 'Projects Locations Persistent Resources Create

Official Vertex AI endpoint: POST /v1/{+parent}/persistentResources
Creates a PersistentResource.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: persistentResourceId.',
  ),
  'persistentResourceId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `persistentResourceId`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1PersistentResource` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/persistentResources';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'persistentResourceId',
);
    protected const BODY_REQUIRED = true;
}
