<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Featurestores Search Features.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+location}/featurestores:searchFeatures.
 */
class GoogleVertexAiProjectsLocationsFeaturestoresSearchFeatures extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_featurestores_search_features';
    protected const DESCRIPTION = 'Projects Locations Featurestores Search Features

Official Vertex AI endpoint: GET /v1/{+location}/featurestores:searchFeatures
Searches Features matching a query in a given project.';
    protected const PARAMETERS = array (
  'location' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `location`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'query' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `query`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+location}/featurestores:searchFeatures';
    protected const PATH_PARAMS = array (
  0 => 'location',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'location',
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'query',
  2 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
}
