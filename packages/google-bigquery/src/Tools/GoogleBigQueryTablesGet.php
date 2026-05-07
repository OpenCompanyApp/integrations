<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Tables Get.
 *
 * Maps to the official BigQuery endpoint GET /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}.
 */
class GoogleBigQueryTablesGet extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_tables_get';
    protected const DESCRIPTION = 'Tables Get

Official BigQuery endpoint: GET /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}
Gets the specified table resource by table ID. This method does not return the data in the table, it only returns the table resource, which describes the structure of this table.';
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
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official BigQuery method. Known keys: selectedFields, view.',
  ),
  'selectedFields' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `selectedFields`.',
  ),
  'view' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `view`.',
  ),
);
    protected const METHOD = 'GET';
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
  0 => 'selectedFields',
  1 => 'view',
);
    protected const BODY_REQUIRED = false;
}
