<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Tensorboards Experiments Runs Time Series Create.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}/timeSeries.
 */
class GoogleVertexAiProjectsLocationsTensorboardsExperimentsRunsTimeSeriesCreate extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_tensorboards_experiments_runs_time_series_create';
    protected const DESCRIPTION = 'Projects Locations Tensorboards Experiments Runs Time Series Create

Official Vertex AI endpoint: POST /v1/{+parent}/timeSeries
Creates a TensorboardTimeSeries.';
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
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: tensorboardTimeSeriesId.',
  ),
  'tensorboardTimeSeriesId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `tensorboardTimeSeriesId`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1TensorboardTimeSeries` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/timeSeries';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'tensorboardTimeSeriesId',
);
    protected const BODY_REQUIRED = true;
}
