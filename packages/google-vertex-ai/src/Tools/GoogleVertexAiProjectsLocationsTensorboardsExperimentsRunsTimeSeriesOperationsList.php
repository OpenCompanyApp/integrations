<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Tensorboards Experiments Runs Time Series Operations List.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+name}/operations.
 */
class GoogleVertexAiProjectsLocationsTensorboardsExperimentsRunsTimeSeriesOperationsList extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_tensorboards_experiments_runs_time_series_operations_list';
    protected const DESCRIPTION = 'Projects Locations Tensorboards Experiments Runs Time Series Operations List

Official Vertex AI endpoint: GET /v1/{+name}/operations
Lists operations that match the specified filter in the request. If the server doesn\'t support this method, it returns `UNIMPLEMENTED`.';
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
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: filter, pageToken, pageSize, returnPartialSuccess.',
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
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'returnPartialSuccess' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `returnPartialSuccess`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+name}/operations';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'filter',
  1 => 'pageToken',
  2 => 'pageSize',
  3 => 'returnPartialSuccess',
);
    protected const BODY_REQUIRED = false;
}
