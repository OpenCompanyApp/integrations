<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Endpoints List.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+parent}/endpoints.
 */
class GoogleVertexAiProjectsLocationsEndpointsList extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_endpoints_list';
    protected const DESCRIPTION = 'Projects Locations Endpoints List

Official Vertex AI endpoint: GET /v1/{+parent}/endpoints
Lists Endpoints in a Location.';
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
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: pageToken, orderBy, filter, gdcZone, readMask, pageSize.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'orderBy' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orderBy`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
  'gdcZone' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `gdcZone`.',
  ),
  'readMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `readMask`.',
  ),
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+parent}/endpoints';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'orderBy',
  2 => 'filter',
  3 => 'gdcZone',
  4 => 'readMask',
  5 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
}
