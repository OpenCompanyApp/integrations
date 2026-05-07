<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Reasoning Engines Sessions List.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+parent}/sessions.
 */
class GoogleVertexAiProjectsLocationsReasoningEnginesSessionsList extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_reasoning_engines_sessions_list';
    protected const DESCRIPTION = 'Projects Locations Reasoning Engines Sessions List

Official Vertex AI endpoint: GET /v1/{+parent}/sessions
Lists Sessions in a given reasoning engine.';
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
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: pageSize, filter, pageToken, orderBy.',
  ),
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+parent}/sessions';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'filter',
  2 => 'pageToken',
  3 => 'orderBy',
);
    protected const BODY_REQUIRED = false;
}
