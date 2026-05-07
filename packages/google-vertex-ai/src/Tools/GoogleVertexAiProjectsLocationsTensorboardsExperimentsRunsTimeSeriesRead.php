<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Tensorboards Experiments Runs Time Series Read.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+tensorboardTimeSeries}:read.
 */
class GoogleVertexAiProjectsLocationsTensorboardsExperimentsRunsTimeSeriesRead extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_tensorboards_experiments_runs_time_series_read';
    protected const DESCRIPTION = 'Projects Locations Tensorboards Experiments Runs Time Series Read

Official Vertex AI endpoint: GET /v1/{+tensorboardTimeSeries}:read
Reads a TensorboardTimeSeries\' data. By default, if the number of data points stored is less than 1000, all data is returned. Otherwise, 1000 data points is randomly selected from this time series and returned. This value can be changed by changing max_data_points, which can\'t be greater than 10k.';
    protected const PARAMETERS = array (
  'tensorboardTimeSeries' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tensorboardTimeSeries`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: filter, maxDataPoints.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
  'maxDataPoints' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `maxDataPoints`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+tensorboardTimeSeries}:read';
    protected const PATH_PARAMS = array (
  0 => 'tensorboardTimeSeries',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'tensorboardTimeSeries',
);
    protected const QUERY_KEYS = array (
  0 => 'filter',
  1 => 'maxDataPoints',
);
    protected const BODY_REQUIRED = false;
}
