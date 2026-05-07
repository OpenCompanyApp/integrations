<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Tensorboards Experiments Write.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+tensorboardExperiment}:write.
 */
class GoogleVertexAiProjectsLocationsTensorboardsExperimentsWrite extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_tensorboards_experiments_write';
    protected const DESCRIPTION = 'Projects Locations Tensorboards Experiments Write

Official Vertex AI endpoint: POST /v1/{+tensorboardExperiment}:write
Write time series data points of multiple TensorboardTimeSeries in multiple TensorboardRun\'s. If any data fail to be ingested, an error is returned.';
    protected const PARAMETERS = array (
  'tensorboardExperiment' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tensorboardExperiment`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1WriteTensorboardExperimentDataRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+tensorboardExperiment}:write';
    protected const PATH_PARAMS = array (
  0 => 'tensorboardExperiment',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'tensorboardExperiment',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
