<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Tensorboards Experiments Runs Time Series Export Tensorboard Time Series.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+tensorboardTimeSeries}:exportTensorboardTimeSeries.
 */
class GoogleVertexAiProjectsLocationsTensorboardsExperimentsRunsTimeSeriesExportTensorboardTimeSeries extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_tensorboards_experiments_runs_time_series_export_tensorboard_time_series';
    protected const DESCRIPTION = 'Projects Locations Tensorboards Experiments Runs Time Series Export Tensorboard Time Series

Official Vertex AI endpoint: POST /v1/{+tensorboardTimeSeries}:exportTensorboardTimeSeries
Exports a TensorboardTimeSeries\' data. Data is returned in paginated responses.';
    protected const PARAMETERS = array (
  'tensorboardTimeSeries' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tensorboardTimeSeries`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1ExportTensorboardTimeSeriesDataRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+tensorboardTimeSeries}:exportTensorboardTimeSeries';
    protected const PATH_PARAMS = array (
  0 => 'tensorboardTimeSeries',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'tensorboardTimeSeries',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
