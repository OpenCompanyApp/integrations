<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Routines List.
 *
 * Maps to the official BigQuery endpoint GET /projects/{+projectId}/datasets/{+datasetId}/routines.
 */
class GoogleBigQueryRoutinesList extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_routines_list';
    protected const DESCRIPTION = 'Routines List

Official BigQuery endpoint: GET /projects/{+projectId}/datasets/{+datasetId}/routines
Lists all routines in the specified dataset. Requires the READER dataset role.';
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
    'description' => 'Query string parameters accepted by the official BigQuery method. Known keys: filter, maxResults, pageToken, readMask.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
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
  'readMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `readMask`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/projects/{+projectId}/datasets/{+datasetId}/routines';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
);
    protected const QUERY_KEYS = array (
  0 => 'filter',
  1 => 'maxResults',
  2 => 'pageToken',
  3 => 'readMask',
);
    protected const BODY_REQUIRED = false;
}
