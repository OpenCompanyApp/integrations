<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Featurestores Create.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}/featurestores.
 */
class GoogleVertexAiProjectsLocationsFeaturestoresCreate extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_featurestores_create';
    protected const DESCRIPTION = 'Projects Locations Featurestores Create

Official Vertex AI endpoint: POST /v1/{+parent}/featurestores
Creates a new Featurestore in a given project and location.';
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
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: featurestoreId.',
  ),
  'featurestoreId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `featurestoreId`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1Featurestore` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/featurestores';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'featurestoreId',
);
    protected const BODY_REQUIRED = true;
}
