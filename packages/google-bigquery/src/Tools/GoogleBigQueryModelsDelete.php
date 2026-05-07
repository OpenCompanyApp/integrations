<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Models Delete.
 *
 * Maps to the official BigQuery endpoint DELETE /projects/{+projectId}/datasets/{+datasetId}/models/{+modelId}.
 */
class GoogleBigQueryModelsDelete extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_models_delete';
    protected const DESCRIPTION = 'Models Delete

Official BigQuery endpoint: DELETE /projects/{+projectId}/datasets/{+datasetId}/models/{+modelId}
Deletes the model specified by modelId from the dataset.';
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
    protected const METHOD = 'DELETE';
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
