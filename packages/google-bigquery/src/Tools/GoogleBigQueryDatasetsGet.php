<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Datasets Get.
 *
 * Maps to the official BigQuery endpoint GET /projects/{+projectId}/datasets/{+datasetId}.
 */
class GoogleBigQueryDatasetsGet extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_datasets_get';
    protected const DESCRIPTION = 'Datasets Get

Official BigQuery endpoint: GET /projects/{+projectId}/datasets/{+datasetId}
Returns the dataset specified by datasetID.';
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
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official BigQuery method. Known keys: accessPolicyVersion, datasetView.',
  ),
  'accessPolicyVersion' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `accessPolicyVersion`.',
  ),
  'datasetView' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `datasetView`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/projects/{+projectId}/datasets/{+datasetId}';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
);
    protected const QUERY_KEYS = array (
  0 => 'accessPolicyVersion',
  1 => 'datasetView',
);
    protected const BODY_REQUIRED = false;
}
