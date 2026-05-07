<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Batch Prediction Jobs Create.
 *
 * Maps to the official Vertex AI endpoint POST /v1/batchPredictionJobs.
 */
class GoogleVertexAiBatchPredictionJobsCreate extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_batch_prediction_jobs_create';
    protected const DESCRIPTION = 'Batch Prediction Jobs Create

Official Vertex AI endpoint: POST /v1/batchPredictionJobs
Creates a BatchPredictionJob. A BatchPredictionJob once created will right away be attempted to start.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: parent.',
  ),
  'parent' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `parent`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1BatchPredictionJob` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/batchPredictionJobs';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'parent',
);
    protected const BODY_REQUIRED = true;
}
