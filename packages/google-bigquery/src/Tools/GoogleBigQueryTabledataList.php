<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Tabledata List.
 *
 * Maps to the official BigQuery endpoint GET /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/data.
 */
class GoogleBigQueryTabledataList extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_tabledata_list';
    protected const DESCRIPTION = 'Tabledata List

Official BigQuery endpoint: GET /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/data
List the content of a table in rows.';
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
    'description' => 'Query string parameters accepted by the official BigQuery method. Known keys: formatOptions.timestampOutputFormat, formatOptions.useInt64Timestamp, maxResults, pageToken, selectedFields, startIndex.',
  ),
  'formatOptions.timestampOutputFormat' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `formatOptions.timestampOutputFormat`.',
  ),
  'formatOptions.useInt64Timestamp' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `formatOptions.useInt64Timestamp`.',
  ),
  'maxResults' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `maxResults`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'selectedFields' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `selectedFields`.',
  ),
  'startIndex' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `startIndex`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/data';
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
  0 => 'formatOptions.timestampOutputFormat',
  1 => 'formatOptions.useInt64Timestamp',
  2 => 'maxResults',
  3 => 'pageToken',
  4 => 'selectedFields',
  5 => 'startIndex',
);
    protected const BODY_REQUIRED = false;
}
