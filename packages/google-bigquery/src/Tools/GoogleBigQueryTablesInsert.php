<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Tables Insert.
 *
 * Maps to the official BigQuery endpoint POST /projects/{+projectId}/datasets/{+datasetId}/tables.
 */
class GoogleBigQueryTablesInsert extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_tables_insert';
    protected const DESCRIPTION = 'Tables Insert

Official BigQuery endpoint: POST /projects/{+projectId}/datasets/{+datasetId}/tables
Creates a new, empty table in the dataset.';
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
    'description' => 'JSON request body matching the official BigQuery `Table` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/projects/{+projectId}/datasets/{+datasetId}/tables';
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
