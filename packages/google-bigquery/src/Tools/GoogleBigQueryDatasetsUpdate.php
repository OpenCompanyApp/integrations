<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Datasets Update.
 *
 * Maps to the official BigQuery endpoint PUT /projects/{+projectId}/datasets/{+datasetId}.
 */
class GoogleBigQueryDatasetsUpdate extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_datasets_update';
    protected const DESCRIPTION = 'Datasets Update

Official BigQuery endpoint: PUT /projects/{+projectId}/datasets/{+datasetId}
Updates information in an existing dataset. The update method replaces the entire dataset resource, whereas the patch method only replaces fields that are provided in the submitted dataset resource.';
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
    'description' => 'Query string parameters accepted by the official BigQuery method. Known keys: accessPolicyVersion, updateMode.',
  ),
  'accessPolicyVersion' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `accessPolicyVersion`.',
  ),
  'updateMode' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `updateMode`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official BigQuery `Dataset` schema.',
  ),
);
    protected const METHOD = 'PUT';
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
  1 => 'updateMode',
);
    protected const BODY_REQUIRED = true;
}
