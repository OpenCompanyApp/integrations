<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Datasets Undelete.
 *
 * Maps to the official BigQuery endpoint POST /projects/{+projectId}/datasets/{+datasetId}:undelete.
 */
class GoogleBigQueryDatasetsUndelete extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_datasets_undelete';
    protected const DESCRIPTION = 'Datasets Undelete

Official BigQuery endpoint: POST /projects/{+projectId}/datasets/{+datasetId}:undelete
Undeletes a dataset which is within time travel window based on datasetId. If a time is specified, the dataset version deleted at that time is undeleted, else the last live version is undeleted.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official BigQuery `UndeleteDatasetRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/projects/{+projectId}/datasets/{+datasetId}:undelete';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
