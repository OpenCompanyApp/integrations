<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Tabledata Insert All.
 *
 * Maps to the official BigQuery endpoint POST /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/insertAll.
 */
class GoogleBigQueryTabledataInsertAll extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_tabledata_insert_all';
    protected const DESCRIPTION = 'Tabledata Insert All

Official BigQuery endpoint: POST /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/insertAll
Streams data into BigQuery one record at a time without needing to run a load job.';
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
  'tableId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tableId`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official BigQuery `TableDataInsertAllRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/insertAll';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
  2 => 'tableId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
  2 => 'tableId',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
