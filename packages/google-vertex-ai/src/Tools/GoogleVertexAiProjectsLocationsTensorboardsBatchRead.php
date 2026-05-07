<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Tensorboards Batch Read.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+tensorboard}:batchRead.
 */
class GoogleVertexAiProjectsLocationsTensorboardsBatchRead extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_tensorboards_batch_read';
    protected const DESCRIPTION = 'Projects Locations Tensorboards Batch Read

Official Vertex AI endpoint: GET /v1/{+tensorboard}:batchRead
Reads multiple TensorboardTimeSeries\' data. The data point number limit is 1000 for scalars, 100 for tensors and blob references. If the number of data points stored is less than the limit, all data is returned. Otherwise, the number limit of data points is randomly selected from this time series and returned.';
    protected const PARAMETERS = array (
  'tensorboard' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tensorboard`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: timeSeries.',
  ),
  'timeSeries' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `timeSeries`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+tensorboard}:batchRead';
    protected const PATH_PARAMS = array (
  0 => 'tensorboard',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'tensorboard',
);
    protected const QUERY_KEYS = array (
  0 => 'timeSeries',
);
    protected const BODY_REQUIRED = false;
}
