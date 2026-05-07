<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Tables List.
 *
 * Maps to the official BigQuery endpoint GET /projects/{+projectId}/datasets/{+datasetId}/tables.
 */
class GoogleBigQueryTablesList extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_tables_list';
    protected const DESCRIPTION = 'Tables List

Official BigQuery endpoint: GET /projects/{+projectId}/datasets/{+datasetId}/tables
Lists all tables in the specified dataset. Requires the READER dataset role.';
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
    'description' => 'Query string parameters accepted by the official BigQuery method. Known keys: maxResults, pageToken.',
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
);
    protected const METHOD = 'GET';
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
  0 => 'maxResults',
  1 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}
