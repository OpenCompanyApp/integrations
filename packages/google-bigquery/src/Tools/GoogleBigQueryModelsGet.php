<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Models Get.
 *
 * Maps to the official BigQuery endpoint GET /projects/{+projectId}/datasets/{+datasetId}/models/{+modelId}.
 */
class GoogleBigQueryModelsGet extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_models_get';
    protected const DESCRIPTION = 'Models Get

Official BigQuery endpoint: GET /projects/{+projectId}/datasets/{+datasetId}/models/{+modelId}
Gets the specified model resource by model ID.';
    protected const PARAMETERS = array (
  'projectId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectId`.',
  ),
  'datasetId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `datasetId`.',
  ),
  'modelId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `modelId`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/projects/{+projectId}/datasets/{+datasetId}/models/{+modelId}';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
  2 => 'modelId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
  2 => 'modelId',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
