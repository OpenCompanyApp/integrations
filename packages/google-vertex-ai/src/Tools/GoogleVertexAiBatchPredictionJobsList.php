<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Batch Prediction Jobs List.
 *
 * Maps to the official Vertex AI endpoint GET /v1/batchPredictionJobs.
 */
class GoogleVertexAiBatchPredictionJobsList extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_batch_prediction_jobs_list';
    protected const DESCRIPTION = 'Batch Prediction Jobs List

Official Vertex AI endpoint: GET /v1/batchPredictionJobs
Lists BatchPredictionJobs in a Location.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: readMask, parent, pageSize, pageToken, filter.',
  ),
  'readMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `readMask`.',
  ),
  'parent' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `parent`.',
  ),
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/batchPredictionJobs';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'readMask',
  1 => 'parent',
  2 => 'pageSize',
  3 => 'pageToken',
  4 => 'filter',
);
    protected const BODY_REQUIRED = false;
}
