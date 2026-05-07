<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Models Patch.
 *
 * Maps to the official BigQuery endpoint PATCH /projects/{+projectId}/datasets/{+datasetId}/models/{+modelId}.
 */
class GoogleBigQueryModelsPatch extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_models_patch';
    protected const DESCRIPTION = 'Models Patch

Official BigQuery endpoint: PATCH /projects/{+projectId}/datasets/{+datasetId}/models/{+modelId}
Patch specific fields in the specified model.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official BigQuery `Model` schema.',
  ),
);
    protected const METHOD = 'PATCH';
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
    protected const BODY_REQUIRED = true;
}
