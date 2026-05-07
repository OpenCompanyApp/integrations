<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Tables Delete.
 *
 * Maps to the official BigQuery endpoint DELETE /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}.
 */
class GoogleBigQueryTablesDelete extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_tables_delete';
    protected const DESCRIPTION = 'Tables Delete

Official BigQuery endpoint: DELETE /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}
Deletes the table specified by tableId from the dataset. If the table contains data, all the data will be deleted.';
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
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}';
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
    protected const BODY_REQUIRED = false;
}
