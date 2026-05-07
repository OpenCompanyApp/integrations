<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Datasets Insert.
 *
 * Maps to the official BigQuery endpoint POST /projects/{+projectId}/datasets.
 */
class GoogleBigQueryDatasetsInsert extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_datasets_insert';
    protected const DESCRIPTION = 'Datasets Insert

Official BigQuery endpoint: POST /projects/{+projectId}/datasets
Creates a new empty dataset.';
    protected const PARAMETERS = array (
  'projectId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectId`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official BigQuery method. Known keys: accessPolicyVersion.',
  ),
  'accessPolicyVersion' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `accessPolicyVersion`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official BigQuery `Dataset` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/projects/{+projectId}/datasets';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'projectId',
);
    protected const QUERY_KEYS = array (
  0 => 'accessPolicyVersion',
);
    protected const BODY_REQUIRED = true;
}
