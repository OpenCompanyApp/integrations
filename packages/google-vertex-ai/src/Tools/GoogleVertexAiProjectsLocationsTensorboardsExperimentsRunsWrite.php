<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Tensorboards Experiments Runs Write.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+tensorboardRun}:write.
 */
class GoogleVertexAiProjectsLocationsTensorboardsExperimentsRunsWrite extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_tensorboards_experiments_runs_write';
    protected const DESCRIPTION = 'Projects Locations Tensorboards Experiments Runs Write

Official Vertex AI endpoint: POST /v1/{+tensorboardRun}:write
Write time series data points into multiple TensorboardTimeSeries under a TensorboardRun. If any data fail to be ingested, an error is returned.';
    protected const PARAMETERS = array (
  'tensorboardRun' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tensorboardRun`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1WriteTensorboardRunDataRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+tensorboardRun}:write';
    protected const PATH_PARAMS = array (
  0 => 'tensorboardRun',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'tensorboardRun',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
