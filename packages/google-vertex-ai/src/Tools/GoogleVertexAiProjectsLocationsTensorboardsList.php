<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Tensorboards List.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+parent}/tensorboards.
 */
class GoogleVertexAiProjectsLocationsTensorboardsList extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_tensorboards_list';
    protected const DESCRIPTION = 'Projects Locations Tensorboards List

Official Vertex AI endpoint: GET /v1/{+parent}/tensorboards
Lists Tensorboards in a Location.';
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
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: filter, pageToken, orderBy, pageSize, readMask.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
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
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'readMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `readMask`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+parent}/tensorboards';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'filter',
  1 => 'pageToken',
  2 => 'orderBy',
  3 => 'pageSize',
  4 => 'readMask',
);
    protected const BODY_REQUIRED = false;
}
