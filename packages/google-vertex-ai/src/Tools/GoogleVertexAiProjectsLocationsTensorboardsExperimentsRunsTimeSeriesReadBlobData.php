<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Tensorboards Experiments Runs Time Series Read Blob Data.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+timeSeries}:readBlobData.
 */
class GoogleVertexAiProjectsLocationsTensorboardsExperimentsRunsTimeSeriesReadBlobData extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_tensorboards_experiments_runs_time_series_read_blob_data';
    protected const DESCRIPTION = 'Projects Locations Tensorboards Experiments Runs Time Series Read Blob Data

Official Vertex AI endpoint: GET /v1/{+timeSeries}:readBlobData
Gets bytes of TensorboardBlobs. This is to allow reading blob data stored in consumer project\'s Cloud Storage bucket without users having to obtain Cloud Storage access permission.';
    protected const PARAMETERS = array (
  'timeSeries' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `timeSeries`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: blobIds.',
  ),
  'blobIds' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `blobIds`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+timeSeries}:readBlobData';
    protected const PATH_PARAMS = array (
  0 => 'timeSeries',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'timeSeries',
);
    protected const QUERY_KEYS = array (
  0 => 'blobIds',
);
    protected const BODY_REQUIRED = false;
}
